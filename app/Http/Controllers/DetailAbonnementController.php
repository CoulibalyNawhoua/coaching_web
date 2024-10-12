<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DetailsAbonnementRepository;

class DetailAbonnementController extends Controller
{
    private $detailAbonnementRepository;
    public function __construct(DetailsAbonnementRepository $detailAbonnementRepository) {

        $this->detailAbonnementRepository = $detailAbonnementRepository;
    }
    public function index()
    {
        $details = $this->detailAbonnementRepository->ListeDetailAbonnement();
        return view('admin.pages.detail-abonnements.index',compact('details'));
    }
    public function create()
    {
        $categories_abonnements = $this->detailAbonnementRepository->ListeCategorieAbonnement();
        return view('admin.pages.detail-abonnements.create', compact('categories_abonnements'));
    }
    public function store(Request $request)
    {
        $this->detailAbonnementRepository->StoreDetailAbonnement($request);
        return redirect()->back()->with('success', 'Enregistrement effectué avec succès!');
    }
    public function edit(string $id)
    {
        $detail = $this->detailAbonnementRepository->edit($id);
        return view('admin.pages.detail-abonnements.edit',compact('detail'));
    }
    public function update(Request $request, string $id)
    {
        $this->detailAbonnementRepository->update_DetailsAbonnement($request, $id);
        return redirect('/detail-abonnemnt')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_detail(Request $request)
    {
        $id = $request->detail_id;
        $this->detailAbonnementRepository->delete_detail($id);
        return response()->json($id);
    }
}
