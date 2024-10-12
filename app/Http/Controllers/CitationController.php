<?php

namespace App\Http\Controllers;

use App\Repositories\RepositoryCitation;
use Illuminate\Http\Request;


class CitationController extends Controller
{
    private $citationRepository;
    public function __construct(RepositoryCitation $citationRepository)
    {
        $this->citationRepository = $citationRepository;
    }
    public function index()
    {
        $categorie_citation = $this->citationRepository->ListCategorie();
        $citations = $this->citationRepository->ListeCitation();
        return view('admin.pages.citations.index', compact('citations', 'categorie_citation'));
    }
    public function create()
    {
        $categorie_citation = $this->citationRepository->ListCategorie();
        return view('admin.pages.citations.create', compact('categorie_citation'));
    }
    public function store(Request $request)
    {
        $this->citationRepository->StoreCitation($request);
        return redirect()->back()->with('success', 'Enregistrement effectué avec succès!');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $categorie_citation = $this->citationRepository->ListCategorie();
        $data = $this->citationRepository->edit_citation($id);
        $citation = $data['citation'];
        $images = $data['images'];
        return view('admin.pages.citations.edit', compact('categorie_citation', 'citation', 'images'));
    }
    public function update(Request $request, string $id)
    {
        $this->citationRepository->update_citation($request, $id);
        return  redirect('/citations')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_citation(Request $request)
    {
        $id = $request->citation_id;
        $this->citationRepository->delete_citation($id);

        return response()->json($id);
    }
    public function countCitationsPubliees()
    {
        $citationTotal = $this->citationRepository->countCitationsPubliees();
        return view('dashboard', compact('citationTotal'));
    }
}
