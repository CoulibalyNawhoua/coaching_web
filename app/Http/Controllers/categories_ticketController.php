<?php

namespace App\Http\Controllers;

use App\Repositories\CategorieTicketRepository;
use Illuminate\Http\Request;

class categories_ticketController extends Controller
{

    private $categorieTicketRepository;
    public function __construct(categorieTicketRepository $categorieTicketRepository)
    {

        $this->categorieTicketRepository = $categorieTicketRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories_tickets = $this->categorieTicketRepository->Liste_CategorieTicket();
        return view('admin.pages.categorie-tickets.index', compact('categories_tickets'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $resp = $this->categorieTicketRepository->StoreCategorieTicket($request);
        return response()->json($resp, 200);
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $categorie_ticket = $this->categorieTicketRepository->edit($id);
        return view('admin.pages.categorie-tickets.edit', compact('categorie_ticket'));

    }
    public function update(Request $request, string $id)
    {
        $this->categorieTicketRepository->update_CategorieTicket($request, $id);
        return  redirect('/categories_tickets')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_CategorieTicket(Request $request)
    {
        $id = $request->CategorieTicket_id;
        $this->categorieTicketRepository->delete_CategorieTicket($id);

        return response()->json($id);
    }
}
