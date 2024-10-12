<?php

namespace App\Repositories\Api;

use App\Models\Abonnement;
use App\Models\AchatsTicket;
use App\Models\Paiement;
use App\Models\Souscription;
use App\Models\Ticket;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TicketRepository extends Repository
{
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }

    public function ListeTickets($dateId)
    {
        $tickets = Ticket::select(
            'tickets.id as id',
            'tickets.prix_tickets',
            'tickets.references_tickets',
            'tickets.libelle',
            'evenements.titles as event_title',
            'evenements.url_images as event_image',
            'dates_evenements.date_evenement',
            'dates_evenements.heure_evenement',
            'dates_evenements.adresse_event'
        )
            ->join('dates_evenements', 'tickets.id_date_event', '=', 'dates_evenements.id')
            ->join('evenements', 'dates_evenements.id_events', '=', 'evenements.id')
            ->where([
                ['tickets.is_deleted', 0],
                ['id_date_event', $dateId]
            ])
            ->orderBy('tickets.add_date', 'DESC')
            ->get();

        if ($tickets->isEmpty()) {
            return response()->json([
                'message' => 'Ticket non disponible',
            ], 422);
        } else {
            return response()->json($tickets);
        }
    }

    public function verifyTicketQuantity(Request $request)
    {
        $ticketId = $request->input('id_tickets');
        $quantityOrdered = $request->input('quantity');

        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        if ($ticket->quantite_tickets >= $quantityOrdered) {
            // Soustraire la quantité commandée de la quantité disponible en base de données
            $ticket->decrement('quantite_tickets', $quantityOrdered);
            $ticket->fresh()->quantite_tickets;

            $user = auth()->id();
            $souscription = Souscription::where([
                ['id_inscription', $user],
                ['status', 1],
            ])->first();

            $reduction = 0;
            $total = $ticket->prix_tickets * $quantityOrdered;

            if ($souscription) {

                $abonnement = Abonnement::find($souscription->id_abonnement);

                // Appliquer la réduction en fonction du libellé de l'abonnement
                if ($abonnement->libelle == 'Members') {
                    $reduction = 0.2; // 20% de réduction
                } elseif ($abonnement->libelle == 'Starter') {
                    $reduction = 0.5; // 50% de réduction
                }
            }

            // Calculer le montant total avec réduction
            $montantTotal = $total * $reduction;
            $montants_paye = $total - $montantTotal;

            $detailsCommande  = [
                'id' => $ticket->id,
                'event_title' => $ticket->evenement->titles,
                'event_image' => $ticket->evenement->url_images,
                'date_evenement' => $ticket->dateEvent->date_evenement,
                'heure_evenement' => $ticket->dateEvent->heure_evenement,
                'adresse_event' => $ticket->dateEvent->adresse_event,
                'references_tickets' => $ticket->references_tickets,
                'prix_tickets' => $ticket->prix_tickets,
                'libelle' => $ticket->libelle,
                'taux_reduction' => $reduction,
                'quantite_tickets' => $quantityOrdered,
                'montant_total' => $montantTotal,
                'total' => $total,
                'montants_paye' =>  $montants_paye,
            ];

            return response()->json([
                'details-ticket' => $detailsCommande,
            ]);
        } else {
            return response()->json(['error' => 'Quantité insuffisante de tickets'], 422);
        }
    }

    public function AchatsTicket(Request $request)
    {

        $references_achats = 'ACHAT-' . time();
        $achat_tickets = AchatsTicket::create([
            'references_achats' => $references_achats,
            'id_inscriptions' => Auth::user()->id,
            'id_tickets' => $request->id_tickets,
            'quantity' => $request->quantity,
            'montants_paye' => $request->montants_paye,
            'add_date' => Carbon::now(),
        ]);

        $validate = $request->validate([
            'montants_paye' => 'required',
        ]);

        if ($validate) {

            $references_paiements = rand(0000, 9999) . time();

            $paiement = Paiement::create([
                'references_paiements' => $references_paiements,
                'montants' => $request->montants_paye,
                'id_achat_ticket' => $achat_tickets->id,
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);

            $donnees = [
                'apiKey' => '262425053964adkcz02q1x.7323710',
                'site_id' => "6076583",
                'transaction_id' => $paiement->references_paiements,
                'amount' => $request->montants_paye,
                // 'currency'=>$currency,
                'description' => "Achat de ticket",
                // 'channels'=>$channels,
                // 'lang'=>$lang,
                // 'notify_url'=>$notify_url_params,
                // 'return_url'=>$return_url,
                'customer_id' => Auth::user()->id,
                'customer_name' => Auth::user()->first_name,
                'customer_surname' => Auth::user()->last_name,
                // 'customer_email'=>Auth::user()->email,
                'customer_phone_number' => Auth::user()->phone,
                // 'customer_address'=>Auth::user()->ad,
                // 'customer_city'=>$customer_city,
                // 'customer_country'=>$customer_country,
                // 'customer_state'=>$customer_state,
                // 'customer_zip_code'=>$customer_zip_code,
                // "metadata" => $metadata

                "distri_seller_name" => "Debora",
                "distri_seller_id" => 1,
                "plateforme_name" => "Coaching-App",

            ];
            // return $donnees;
            $response = Http::post('https://distripay-sanbox-api.distriforce.shop/api/distriforce-check/payment', $donnees);
            // $responseStatus = $response->status();
            $contenu = $response->json();
            // return $contenu;
            if ($contenu["code"] == 201) {
                return response()->json([
                    'payment_url' => $contenu["data"]["payment_url"],
                    'transaction_id' => $paiement->references_paiements,
                    'achat_tickets_id' => $achat_tickets->id,
                    'paiement_id' => $paiement->id,
                    'status' => 1,

                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'Error' => $contenu,
                    'message' => 'Echec du payement veillez reessayer plus tard !',
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Echec de la souscription veiller réessayer',
            ]);
        }
    }
    public function updatePaiement($paiementId, $achatTicketId)
    {
        $user = Auth::user();
        $paiement = Paiement::find($paiementId);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }

        $paiement->update([
            'status' => 1,
            'edit_date' => Carbon::now(),
            'edited_by' => $user->id,
        ]);

        // $paiement->status = 1;
        // $paiement->edited_by = Auth::user()->id;
        // $paiement->edit_date = Carbon::now();
        // $paiement->update();


        $achatTicket  = AchatsTicket::find($achatTicketId);
        if (!$achatTicket) {
            return response()->json(['message' => 'Aucun achat non trouvée'], 404);
        }
        $achatTicket->update([
            'status' => 1,
            'edit_date' => Carbon::now(),
            'edited_by' => $user->id,
        ]);

        return response()->json([
            'status_paiement' => $paiement->status,
            'status_achat' => $achatTicket->status,
        ]);
    }

    public function detailsTicket()
    {
        $user = Auth::user();
    
        $achatTicket = AchatsTicket::where('id_inscriptions', $user->id)
            ->where('status', 1)
            ->first();
    
        if (!$achatTicket) {
            return response()->json(['message' => 'Aucun ticket acheté trouvé'], 404);
        }
    
        $ticket = Ticket::join('dates_evenements', 'tickets.id_date_event', '=', 'dates_evenements.id')
            ->join('evenements', 'dates_evenements.id_events', '=', 'evenements.id')
            ->where([
                ['tickets.id', $achatTicket->id_tickets],
                ['tickets.is_deleted', 0],
            ])
            ->select(
                'tickets.references_tickets', 
                'tickets.prix_tickets', 
                'evenements.titles', 
                'evenements.url_images', 
                'dates_evenements.date_evenement', 
                'dates_evenements.heure_evenement', 
                'dates_evenements.adresse_event',
            )->first();
    
        return response()->json(['ticket_infos' => $ticket]);
    }


}
