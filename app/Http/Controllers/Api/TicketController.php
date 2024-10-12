<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\TicketRepository;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketRepository;
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }
    public function listeTickets($dateId)
    {
      return $this->ticketRepository->ListeTickets($dateId);
       
    }
    public function AchatsTickets(Request $request)
    {
        return $this->ticketRepository->AchatsTicket($request);
        
    }
    public function verifyTicketQuantity(Request $request)
    {
        return $this->ticketRepository->verifyTicketQuantity($request);
        
    }
    public function updateStatus($paiementId,$achatTicketId)
    {
        return  $this->ticketRepository->updatePaiement($paiementId,$achatTicketId);
    
    }
    public function detailsTicket()
    {
        return  $this->ticketRepository->detailsTicket();
    
    }
}
