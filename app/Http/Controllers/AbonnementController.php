<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AbonnementRepository;

class AbonnementController extends Controller
{
    private $abonnementRepository;
    public function __construct(AbonnementRepository $abonnementRepository)
    {
        $this->abonnementRepository = $abonnementRepository;
    }

    public function index()
    {
        $categories_abonnements = $this->abonnementRepository->ListeCategorieAbonnement();
        $abonnements = $this->abonnementRepository->Liste_Abonnement();
        return view('admin.pages.abonnements.index', compact('categories_abonnements','abonnements'));
    }

    public function create()
    {
        $categories_abonnements = $this->abonnementRepository->ListeCategorieAbonnement();
        $periodes_abonnements = $this->abonnementRepository->ListePeriodeAbonnement();
        $offres_abonnements = $this->abonnementRepository->ListeOffreAbonnement();
        return view('admin.pages.abonnements.create',compact('categories_abonnements','offres_abonnements','periodes_abonnements'));
    }

    public function ListeAbonne()
    {
        $users_abonnes = $this->abonnementRepository->listeUsersSubscriptions();
        // dd($users_abonnes);
        return view('admin.pages.abonnements.liste-abonnes',compact("users_abonnes"));
    }

    public function store(Request $request)
    {
        $this->abonnementRepository->StoreAbonnement($request);
        return redirect('/abonnements')->with('success', 'Enregistrement effectué avec succès!');
    }

    public function edit(string $id)
    {
        $abonnement = $this->abonnementRepository->edit_Abonnement($id);
        $offres = $this->abonnementRepository->ListeOffreAbonnement();
        $categories_abonnements = $this->abonnementRepository->ListeCategorieAbonnement();
        $periodes_abonnements = $this->abonnementRepository->ListePeriodeAbonnement();
        return view('admin.pages.abonnements.edit',compact('categories_abonnements','abonnement','offres','periodes_abonnements'));
    }

    public function update(Request $request, string $id)
    {
        $this->abonnementRepository->update_abonnement($request, $id);
        return redirect('/abonnements')->with('success', 'Modification effectuée avec succès!');
    }

    public function delete_abonnement(Request $request)
    {
        $id = $request->abonnement_id;
        $this->abonnementRepository->delete($id);
        return response()->json($id);
    }

    public function ListePaiement()
    {
        $paiements = $this->abonnementRepository->getPaymentsForSubscription();
        return view('admin.pages.abonnements.paiement',compact("paiements"));
    }
    public function countUsersSouscrits()
    {
        $paiements = $this->abonnementRepository->getPaymentsForSubscription();
        return view('admin.pages.abonnements.paiement',compact("paiements"));
    }
    
    
    
}
