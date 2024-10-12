<?php

namespace App\Repositories\Api;

use Carbon\Carbon;
use App\Models\Paiement;
use App\Models\Abonnement;
use App\Models\Souscription;
use Illuminate\Http\Request;
use App\Models\Citation;
use App\Models\OffreAbonnement;
use App\Models\DetailAbonnement;
use App\Models\Ticket;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class AbonnementRepository extends Repository
{
    public function __construct(Abonnement $model)
    {
        $this->model = $model;
    }

    public function ListeAbonnement()
    {
        $abonnements = Abonnement::join('periode_abonnement', 'abonnements.id_dure_abonnement', '=', 'periode_abonnement.id')
            ->select('abonnements.id', 'abonnements.libelle', 'abonnements.prix_abonnements', 'periode_abonnement.periode')
            ->where([
                ['abonnements.is_deleted', 0]
            ])
            ->get();
        return response()->json(['abonnements' => $abonnements]);
    }

    public function DetailsAbonnement($abonID)
    {
        $abonnement = Abonnement::find($abonID);

        if (!$abonnement) {
            return response()->json(['error' => 'Abonnement non trouvé'], 404);
        }
        $offres = DetailAbonnement::where("id_abonnement", $abonnement->id)
            ->leftJoin('offres_abonnements', 'offres_abonnements.id', '=', 'details_abonnements.id_offre')
            ->select('offres_abonnements.offres')
            ->get();
        return response()->json([
            'id' => $abonnement->id,
            'libelle' => $abonnement->libelle,
            'offres' => $offres,
        ]);
    }

    public function SouscriptionAbonnement(Request $request)
    {
        $abonnementId = $request->input('id_abonnement');
        $souscription = Souscription::create([
            'id_inscription' => Auth::user()->id,
            'id_abonnement' => $abonnementId,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);


        if (!$abonnementId) {
            return response()->json(['message' => 'Abonnement non trouvé'], 404);
        }


        $validate = $request->validate([
            'prix_abonnements' => 'required',
        ]);

        if ($validate) {

            $references_paiements = rand(0000, 9999) . time();

            $paiement = Paiement::create([
                'references_paiements' => $references_paiements,
                'montants' => $request->prix_abonnements,
                'id_souscription_abonnement' => $souscription->id,
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);

            $donnees = [
                'apiKey' => '262425053964adkcz02q1x.7323710',
                'site_id' => "6076583",
                'transaction_id' => $paiement->references_paiements,
                'amount' => $request->prix_abonnements,
                // 'currency'=>$currency,
                'description' => "Souscription abonnement",
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

            $response = Http::post('https://distripay-sanbox-api.distriforce.shop/api/distriforce-check/payment', $donnees);


            // $responseStatus = $response->status();
            $contenu = $response->json();
            // return $contenu;
            if ($contenu["code"] == 201) {
                return response()->json([
                    'payment_url' => $contenu["data"]["payment_url"],
                    'transaction_id' => $paiement->references_paiements,
                    'paiement_id' => $paiement->id,
                    'souscription_id' => $souscription->id,

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
    public function updatePaiement($paiementId, $souscriptionId)
    {
        $user = Auth::user();
        $paiement = Paiement::find($paiementId);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement non trouvé'], 404);
        }

        $souscription = Souscription::where('id_inscription', $user->id)
            ->where('status', 1)
            ->first();

        if ($souscription) {
            // Désactiver l'abonnement actif
            $souscription->update([
                'status' => 2,
                'edit_date' => Carbon::now(),
                'edited_by' => $user->id,
            ]);
        }

        $paiement->status = 1;
        $paiement->edited_by = Auth::user()->id;
        $paiement->edit_date = Carbon::now();
        $paiement->update();

        $souscription = Souscription::find($souscriptionId);
        if (!$souscription) {
            return response()->json(['message' => 'Souscription non trouvée'], 404);
        }
        $souscription->status = 1;
        $souscription->edited_by = Auth::user()->id;
        $souscription->edit_date = Carbon::now();
        $souscription->update();

        $abonnementInfo = $this->userAbonnement();

        return response()->json([
            'status_paiement' => $paiement->status,
            'status_souscription' => $souscription->status,
            'abonnement_info' => $abonnementInfo,
        ]);
    }


    public function verifierAbonnement()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        $souscription = Souscription::where('id_inscription', $user->id)
            ->where('status', 1)
            ->first();

        if ($souscription) {
            return response()->json(['has_subscription' => true]);
        } else {
            return response()->json(['has_subscription' => false]);
        }
    }


    public function userAbonnement()
    {
        $user = Auth::user();
        $souscription = Souscription::where('id_inscription', $user->id)
            ->where('status', 1)
            ->first();

        if (!$souscription) {
            return response()->json(['message' => 'Aucun paiement en cours pour cet utilisateur'], 404);
        }

        $abonnement = Abonnement::join('periode_abonnement', 'abonnements.id_dure_abonnement', '=', 'periode_abonnement.id')
            ->where('abonnements.id', $souscription->id_abonnement)
            ->select('abonnements.id', 'abonnements.libelle', 'abonnements.prix_abonnements', 'periode_abonnement.periode')
            ->first();

        if (!$abonnement) {
            return response()->json(['message' => 'Abonnement introuvable'], 404);
        }

        

        // Récupérer les offres liées à cet abonnement
        $offres = OffreAbonnement::join('details_abonnements', 'offres_abonnements.id', '=', 'details_abonnements.id_offre')
            ->where('details_abonnements.id_abonnement', $abonnement->id)
            ->select('offres_abonnements.offres')
            ->get();

        return [
            'abonnement' => $abonnement,
            'offres' => $offres,


        ];
    }


    public function getAccesUtilisateur()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }

        // Vérifier si l'utilisateur a un abonnement actif
        $souscription = Souscription::where('id_inscription', Auth::user()->id)
            ->where('status', 1)
            ->first();

        if (!$souscription) {
            return response()->json(['message' => 'Aucun paiement en cours pour cet utilisateur'], 404);
        }

        // Récupérer les détails de l'abonnement lié à la souscription
        $abonnement = Abonnement::with('categorieAbonnement')->find($souscription->id_abonnement);

        if (!$abonnement) {
            return response()->json(['message' => 'Aucun abonnement trouvé pour cet utilisateur'], 404);
        }

        // Récupérer les informations sur la catégorie d'abonnement
        $categorieAbonnement = $abonnement->categorieAbonnement->name;

        // Appliquez des règles en fonction du catégorie d'abonnement
        if ($categorieAbonnement == 'Starter') {
            $citations = Citation::leftJoin('galeries', 'galeries.id_citations', '=', 'citations.id')
                ->select('citations.contenu', 'galeries.url_medias')
                ->get();
        } elseif ($categorieAbonnement == 'Members') {
            $citations = Citation::leftJoin('galeries', 'galeries.id_citations', '=', 'citations.id')
                ->select('citations.contenu', 'galeries.url_medias')
                ->get();
            // $citationsAudios = true;
            //une réduction de 20% sur chaque achat de ticket
            $tauxReduction = 20;
            // Récupérer tous les tickets disponibles
            $tickets = Ticket::all();
            // Appliquer la réduction sur chaque ticket
            foreach ($tickets as $ticket) {
                $ticket->prix_tickets = $ticket->prix_tickets - ($ticket->prix_tickets * $tauxReduction / 100);
                $ticket->save();
            }
        } else {
            $citations = Citation::leftJoin('galeries', 'galeries.id_citations', '=', 'citations.id')
                ->select('citations.contenu', 'galeries.url_medias')
                ->get();

            $tauxReduction = 50;
            $tickets = Ticket::all();
            foreach ($tickets as $ticket) {
                $ticket->prix_tickets = $ticket->prix_tickets - ($ticket->prix_tickets * $tauxReduction / 100);
                $ticket->save();
            }
        }

        return response()->json([
            'categorie_abonnement' => $categorieAbonnement,
            'citations' => $citations,
            'taux_reduction' => $tauxReduction ?? 0,
        ]);
    }
}
