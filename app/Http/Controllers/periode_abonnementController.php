<?php

namespace App\Http\Controllers;

use App\Repositories\PeriodeAbonnementRepository;
use Illuminate\Http\Request;

class periode_abonnementController extends Controller
{
    private $periodeAbonnementRepository;
    public function __construct(PeriodeAbonnementRepository $periodeAbonnementRepository) {

        $this->periodeAbonnementRepository = $periodeAbonnementRepository;
    }

    public function index()
    {
        $periodes_abonnements = $this->periodeAbonnementRepository->Liste_PeriodeAbonnement();
        return view('admin.pages.periode-abonnements.index',compact('periodes_abonnements'));
    }
    public function create()
    {

    }

    public function store(Request $request)
    {
        $resp = $this->periodeAbonnementRepository->StorePeriodeAbonnement($request);
        return response()->json($resp, 200);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $periode_abonnement = $this->periodeAbonnementRepository->edit($id);
        return view('admin.pages.periode-abonnements.edit',compact('periode_abonnement'));
    }

    public function update(Request $request, string $id)
    {
        $this->periodeAbonnementRepository->update_PeriodeAbonnement($request, $id);
        return  redirect('/periodes_abonnements')->with('success', 'Modification effectuée avec succès!');
    }

    public function delete_periode(Request $request)
    {
        $id = $request->PeriodeAbonnement_id;
        $this->periodeAbonnementRepository->delete_periode($id);

        return response()->json($id);
    }
}
