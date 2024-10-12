<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaiementRepository;

class PaiementController extends Controller
{
    private $paiementRepository;
    public function __construct(PaiementRepository $paiementRepository)
    {

        $this->paiementRepository = $paiementRepository;
    }
    public function index()
    {
        $paiements = $this->paiementRepository->ListPaiement();
        return view('admin.pages.paiement.index',compact('paiements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
