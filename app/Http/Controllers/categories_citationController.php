<?php

namespace App\Http\Controllers;

use App\Repositories\CategorieCitationRepository;
use Illuminate\Http\Request;

class categories_citationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private $categorieRepository;
     public function __construct(CategorieCitationRepository $categorieRepository) {

         $this->categorieRepository = $categorieRepository;
     }
    public function index()
    {
        $categorie_citation = $this->categorieRepository->Liste_CategorieCitation();
        return view('admin.pages.categories-citations.index',compact('categorie_citation'));
    }


    public function store(Request $request)
    {
        $resp = $this->categorieRepository->StoreCategorieCitation($request);
        return response()->json($resp, 200);
    }

    public function edit(string $id)
    {
        $categorie_citation = $this->categorieRepository->edit($id);
        return view('admin.pages.categories-citations.edit', compact('categorie_citation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->categorieRepository->update_CategorieCitation($request, $id);
        return  redirect('/categories_citations')->with('success', 'Modification effectuée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete_categorie(Request $request)
    {
        $id = $request->categorie_id;
        $this->categorieRepository->delete_categorie($id);

        return response()->json($id);
    }
}
