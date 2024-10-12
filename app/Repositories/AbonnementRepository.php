<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Models\OffreAbonnement;
use App\Repositories\Repository;
use App\Models\CategorieAbonnement;
use App\Models\Inscription;
use App\Models\Paiement;
use App\Models\PeriodeAbonnement;
use App\Models\Souscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbonnementRepository extends Repository
{
    public function __construct(Abonnement $model)
    {
        $this->model = $model;
    }
    public function getDate()
    {
        date_default_timezone_set('Africa/Abidjan');
        return date_format(date_create(date('Ymd H:i:s')), 'Ymd H:i:s');
    }
    public function ListeCategorieAbonnement()
    {
        $categories_abonnements = CategorieAbonnement::where('is_deleted', 0)->get();
        return $categories_abonnements;
    }
    public function ListePeriodeAbonnement()
    {
        $periodes_abonnements = PeriodeAbonnement::where('is_deleted', 0)->get();
        return $periodes_abonnements;
    }

    public function ListeOffreAbonnement()
    {
        $offre_abonnement = OffreAbonnement::where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return $offre_abonnement;
    }
    public function StoreAbonnement(Request $request)
    {
      

        $references = rand(0000, 9999) . time();
        $abonnements = Abonnement::create([
            'references_abonnements' => $references,
            'libelle' => $request->libelle,
            'id_categories_abonnements' => $request->id_categories_abonnements,
            'id_dure_abonnement' => $request->id_dure_abonnement,
            'prix_abonnements' => $request->prix_abonnements,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);

        // Crée un tableau pour stocker les identifiants des offres sélectionnées
        $offress = $request->input('offres', []);

        // Joindre les enregistrements OffreAbonnement sélectionnés à l'Abonnement
        $abonnements->offresAbonnement()->attach($offress);
        return $abonnements;
        // autre methode
        // Synchronise les enregistrements "OffreAbonnement" associés
        // $abonnements->offres()->sync($request->input('offres', []));

        
    }
    public function edit_Abonnement($id)
    {
        $abonnement = Abonnement::find($id);
        
        return $abonnement;
    }
    
    public function Liste_Abonnement()
    {
        $abonnements = Abonnement::where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return $abonnements;
    }
   

    public function update_abonnement(Request $request, $id)
    {
        $abonnement = Abonnement::find($id);
        $abonnement->update([
            'libelle' => $request->libelle,
            'id_categories_abonnements' => $request->id_categories_abonnements,
            'id_dure_abonnement' => $request->id_dure_abonnement,
            'prix_abonnements' => $request->prix_abonnements,
            'edited_by' => Auth::user()->id,
            'edit_date' => Carbon::now(),
        ]);
        $abonnement->offresAbonnement()->sync($request->input('offres', []));
        return $abonnement;
    }

    public function delete($id)
    {
        $abonnement = $this->model->find($id);

        $abonnement->is_deleted = 1;
        $abonnement->deleted_by = Auth::user()->id;
        $abonnement->delete_date = Carbon::now();
        $abonnement->save();
    }

    public function listeUsersSubscriptions()
    {
        $usersSubscriptions = Inscription::join('souscriptions', 'inscriptions.id', '=', 'souscriptions.id_inscription')
            ->join('abonnements', 'souscriptions.id_abonnement', '=', 'abonnements.id')
            ->where([
                ['souscriptions.status', 1],
                ['souscriptions.is_deleted', 0]
            ])
            ->select('inscriptions.id', 'inscriptions.first_name', 'inscriptions.last_name', 'inscriptions.phone', 'inscriptions.adresse', 'inscriptions.genre')
            ->orderBy('souscriptions.add_date', 'DESC')
            ->get();
        return $usersSubscriptions;
    }

    public function getPaymentsForSubscription()
    {
        $payments = Paiement::join('souscriptions', 'paiements.id_souscription_abonnement', '=', 'souscriptions.id')
            ->join('abonnements', 'souscriptions.id_abonnement', '=', 'abonnements.id')
            ->select('paiements.references_paiements', 'paiements.montants', 'abonnements.references_abonnements', 'paiements.add_date', 'abonnements.libelle')
            ->where([
                ['paiements.is_deleted', 0],
                ['paiements.status', 1],
                ['souscriptions.status', 1]
            ])
            ->orderBy('paiements.add_date', 'DESC')
            ->get();

        return $payments;
    }

    public function countUsersSouscrits()
    {
        $userSouscrits = Souscription::join('paiements', 'souscriptions.id', '=', 'paiements.id_souscription_abonnement')
            ->where([
                ['souscriptions.status', 1],
                ['paiements.status', 1],
            ])
            ->count();
        return $userSouscrits;
    }
    
}
