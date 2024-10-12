<?php

namespace App\Repositories\Api;


use App\Models\Abonnement;
use App\Models\Inscription;
use Carbon\Carbon;
use App\Models\Paiement;
use App\Models\Souscription;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;



class SouscriptionRepository extends Repository
{

    public function __construct(Souscription $model)
    {
        $this->model = $model;
    }
    public function StoreSouscription($request)
    {
        $validate = $request->validate([
            'montants' => 'required',
            'moyen_paiements' => 'required',
            'telephone' => '|digits:10|numeric',
        ]);

        if ($validate) {

            $references_paiements = 'PAIEMENT-'.time();

            $paiement = Paiement::create([
                'references_paiements' => $references_paiements,
                'montants' => $request->montants,
                'moyen_paiements' => $request->moyen_paiements,
                'telephone' => $request->telephone,
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);

            $id_inscription = $request->input('id_inscription');
            $id_abonnement = $request->input('id_abonnement');

            $id_inscrit = Inscription::find($id_inscription);
            $id_abonnement = Abonnement::find($id_abonnement);

            if (!$id_inscrit) {
                return response()->json([
                    'status' => 401,
                    'message' => 'L\'utilisateur n\'existe pas.',
                ]);
            }
            if (!$id_abonnement) {
                return response()->json([
                    'status' => 401,
                    'message' => 'L\'aboonement n\'existe pas.',
                ]);
            }

            $souscription = Souscription::create([
                'id_inscription' => $id_inscrit->id,
                'id_paiement' => $paiement->id,
                'id_abonnement' => $id_abonnement->id,
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Souscription effectuée avec succès',
                'paiements' => $paiement,
                'souscription' => $souscription,
            ]);

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Echec de la souscription veiller réessayer',
            ]);
        }

    }


}
