<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\AchatsTicketsRepository;

class AchatsTicketsController extends Controller
{
    private $achatsticketsRepository;

    public function __construct(AchatsTicketsRepository $achatsticketsRepository)
    {
        $this->achatsticketsRepository = $achatsticketsRepository;
    }
    // public function AchatsTickets(Request $request)
    // {
    //     return $this->achatsticketsRepository->AchatsTicket($request);
        
    // }
    public function updateStatus($id)
    {
        return $this->achatsticketsRepository->updateStatus($id);
    }
    public function getTicket($paiementId)
    {
        return $this->achatsticketsRepository->getTicket($paiementId);
    }
}
