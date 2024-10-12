<?php

namespace App\Http\Controllers;

use App\Repositories\OffresAbonnementRepository;
use Illuminate\Http\Request;

class OffresAbonnementController extends Controller
{
    private $offresAbonnementRepository;
    public function __construct(OffresAbonnementRepository $offresAbonnementRepository) {

        $this->offresAbonnementRepository = $offresAbonnementRepository;
    }

    public function index()
    {
        $offres_abonnement = $this->offresAbonnementRepository->ListeOffresAbonnement();
        return view("admin.pages.offres-abonnements.index", compact("offres_abonnement"));

    }
    public function create()
    {
        return view("admin.pages.offres-abonnements.create");
    }

    public function store(Request $request)
    {
       $response = $this->offresAbonnementRepository->StoreOffresAbonnement($request);
        return response()->json($response, 200);
    }
    public function edit(string $id)
    {
        $offres = $this->offresAbonnementRepository->edit($id);
        return view("admin.pages.offres-abonnements.edit", compact("offres"));
    }

    public function update(Request $request, string $id)
    {
         $this->offresAbonnementRepository->updateOffresAbonnement($request, $id);
        return  redirect('/offres_abonnements')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_offre(Request $request)
    {
        $id = $request->Offre_id;
        $this->offresAbonnementRepository->deleteOffre($id);
        return response()->json($id);
    }
}
