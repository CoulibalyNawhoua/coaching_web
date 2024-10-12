<?php

namespace App\Repositories\Api;


use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Paiement;
use App\Models\AchatsTicket;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class AchatsTicketsRepository extends Repository
{

    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }
    public function AchatsTicket(Request $request)
    {
        $references_achats = 'ACHAT-'. time();
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
                'customer_id'=>Auth::user()->id,
                'customer_name'=>Auth::user()->first_name,
                'customer_surname'=>Auth::user()->last_name,
                // 'customer_email'=>Auth::user()->email,
                'customer_phone_number'=>Auth::user()->phone,
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
                    'paiement_id' => $paiement->id, // Ajoutez ceci pour retourner l'ID du paiement

                ]);

            } else {
                return response()->json([
                    'status' => 400,
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
    public function updateStatus($id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }

        $paiement->status = 1;
        $paiement->edited_by = Auth::user()->id;
        $paiement->edit_date = Carbon::now();
        $paiement->update();
        return response()->json(['status' => $paiement->status]);
    }

    public function getTicket($paiementId)
    {
        // Récupérer le paiement par son ID
        $paiement = Paiement::find($paiementId);

        // verifier status du paiement
        if (!$paiement || $paiement->status != 1) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }
        // Récupérer les détails du ticket associé à l'achat
        $achatTicket = AchatsTicket::where('id', $paiement->id_achat_ticket)->first();

        if (!$achatTicket) {
            return response()->json(['message' => 'Achat de ticket non trouvé.'], 404);
        }

        // Récupérer les détails du ticket
        $ticket = Ticket::find($achatTicket->id_tickets);

        if (!$ticket) {
            return response()->json(['message' => 'Ticket non trouvé.'], 404);
        }

        // Construire la réponse
        $ticketDetails = [
            'id' => $ticket->id,
            'event_title' => $ticket->evenement->titles,
            'event_image' => $ticket->evenement->url_images,
            'date_evenement' => $ticket->dateEvent->date_evenement,
            'heure_evenement' => $ticket->dateEvent->heure_evenement,
            'adresse_event' => $ticket->dateEvent->adresse_event,
            'references_tickets' => $ticket->references_tickets,
            'prix_tickets' => $ticket->prix_tickets,
            'category_name' => $ticket->category->name,
        ];

        return response()->json($ticketDetails);
    }
 

    
}


