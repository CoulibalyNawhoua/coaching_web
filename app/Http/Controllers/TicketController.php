<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TicketRepository;

class TicketController extends Controller
{
    private $ticketRepository;
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }
    public function index()
    {
        $listeEvents = $this->ticketRepository->ListeEvent();
        // $categorieTickets = $this->ticketRepository->Liste_CategorieTicket();
        $tickets = $this->ticketRepository->ListeTickets();
        return view('admin.pages.tickets.index', compact('tickets', 'listeEvents'));
    }
    public function create()
    {
        $listeEvents = $this->ticketRepository->ListeEvent();
        $categorieTickets = $this->ticketRepository->Liste_CategorieTicket();
        $dates = [];
        return view('admin.pages.tickets.create', compact('listeEvents','dates'));
    }

    public function getDatesByEvent($eventId)
    {
       return $this->ticketRepository->getDatesByEvent($eventId);
    }

    public function store(Request $request)
    {
        $this->ticketRepository->StoreTickets($request);
        return redirect()->back()->with('success', 'Enregistrement effectué avec succès!');
    }
    public function edit(string $id)
    {
        $listeEvents = $this->ticketRepository->ListeEvent();
        $categorieTickets = $this->ticketRepository->Liste_CategorieTicket();
        $ticket = $this->ticketRepository->edit($id);

        return view('admin.pages.tickets.edit', compact('listeEvents', 'categorieTickets', 'ticket'));
    }
    public function update(Request $request, string $id)
    {
        $this->ticketRepository->update_ticket($request, $id);
        return redirect('/tickets')->with('success', 'Modification effectuée avec succès!');
    }

    public function delete_ticket(Request $request)
    {
        $id = $request->ticket_id;
        $this->ticketRepository->delete_ticket($id);

        return response()->json($id);
    }

    public function listTicketsVendus()
    {
       $ticketsVendus = $this->ticketRepository->ticketsVendus();
    //    dd($ticketsVendus);
        return view('admin.pages.tickets.liste-tickets-vendus', compact('ticketsVendus'));
    }
}
