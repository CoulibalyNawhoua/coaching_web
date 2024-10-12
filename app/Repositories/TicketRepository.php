<?php

namespace App\Repositories;

use App\Models\AchatsTicket;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\DateEvent;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\CategorieTicket;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;


class TicketRepository extends Repository
{
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }
    public function ListeEvent()
    {
        $all_evenements = Evenement::where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return $all_evenements;
    }

    public function getDatesByEvent($eventId)
    {
        $dates = DateEvent::where('id_events', $eventId)->where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return response()->json($dates);
    }

    public function StoreTickets(Request $request)
    {
        $references_tickets = 'TICKET-' . time();

        $libelle = $request->input('libelle');
        $prix_tickets = $request->input('prix_tickets');
        $taux_reduction = $request->input('taux_reduction');
        $quantite_tickets = $request->input('quantite_tickets');

        for ($i = 0; $i < count($libelle); $i++) {

            $tickets = Ticket::create([
                'references_tickets' => $references_tickets,
                'id_events' => $request->id_events,
                'id_date_event' => $request->id_date_event,
                'libelle' => $libelle[$i],
                'prix_tickets' => $prix_tickets[$i],
                'taux_reduction' => $taux_reduction[$i],
                'quantite_tickets' => $quantite_tickets[$i],
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);
        }

        return $tickets;
    }
    public function Liste_CategorieTicket()
    {
        $categories_tickets = CategorieTicket::where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return $categories_tickets;
    }
    public function ListeTickets()
    {

        $tickets = Ticket::where('tickets.is_deleted', 0)
            ->leftJoin('evenements', 'evenements.id', '=', 'tickets.id_events')
            ->selectRaw('tickets.libelle, evenements.titles, tickets.prix_tickets, tickets.quantite_tickets, tickets.taux_reduction, tickets.references_tickets, tickets.quantite_tickets, tickets.add_date, tickets.taux_reduction, tickets.id')
            ->orderBy('add_date', 'DESC')
            ->get();

        return $tickets;
    }
    public function update_ticket($request, $id)
    {
        $ticket = $this->model->find($id);
        $ticket->id_events = $request->id_events;
        $ticket->libelle = $request->libelle;
        $ticket->prix_tickets = $request->prix_tickets;
        $ticket->quantite_tickets = $request->quantite_tickets;
        $ticket->taux_reduction = $request->taux_reduction;
        $ticket->edited_by = Auth::user()->id;
        $ticket->edit_date = Carbon::now();
        $ticket->update();
        return $ticket;
    }
    public function delete_ticket($id)
    {
        $ticket = $this->model->find($id);
        $ticket->is_deleted = 1;
        $ticket->deleted_by = Auth::user()->id;
        $ticket->delete_date = Carbon::now();

        $ticket->save();
    }

    public function ticketsVendus()
    {
        $ticketVendus = AchatsTicket::join('tickets', 'achats_tickets.id_tickets', '=', 'tickets.id')
            ->join('paiements', 'achats_tickets.id', '=', 'paiements.id_achat_ticket')
            ->where([
                ['achats_tickets.status', 1],
                ['paiements.status', 1],
                ['achats_tickets.is_deleted', 0],
            ])
            ->select('tickets.references_tickets', 'tickets.prix_tickets', 'tickets.libelle')
            ->groupBy('tickets.references_tickets', 'tickets.prix_tickets', 'tickets.libelle')
            ->selectRaw('count(*) as total_vendu')
            ->get();

        return $ticketVendus;
    }
   
}
