<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategorieAbonnementRepository;

class categorie_abonnementController extends Controller
{
    private $categorieAbonnementRepository;
    public function __construct(CategorieAbonnementRepository $categorieAbonnementRepository) {

        $this->categorieAbonnementRepository = $categorieAbonnementRepository;
    }

    public function index()
    {
        $categories_abonnements = $this->categorieAbonnementRepository->Liste_CategorieAbonnement();
        return view('admin.pages.categorie-abonnements.index',compact('categories_abonnements'));
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        $resp = $this->categorieAbonnementRepository->StoreCategorieAbonnement($request);
        return response()->json($resp, 200);
    }
    public function edit(string $id)
    {
        $categorie_abonnement = $this->categorieAbonnementRepository->edit($id);
        return view('admin.pages.categorie-abonnements.edit',compact('categorie_abonnement'));
    }
    public function update(Request $request, string $id)
    {
        $this->categorieAbonnementRepository->update_CategorieAbonnement($request, $id);
        return  redirect('/categories_abonnements')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_abonnement(Request $request)
    {
        $id = $request->CategorieAbonnement_id;
        $this->categorieAbonnementRepository->delete_abonnement($id);

        return response()->json($id);
    }
}
