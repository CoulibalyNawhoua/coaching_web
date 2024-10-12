<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\EventRepository;

class EvenementController extends Controller
{
    private $evenementRepository;
    public function __construct(EventRepository $evenementRepository)
    {
        $this->evenementRepository = $evenementRepository;
    }
    public function ListeEvenement()
    {
       return $this->evenementRepository->ListeEvenement();
    } 
    
    public function detailsEvenements($eventID)
    {
       return $this->evenementRepository->DetailsEvent($eventID);
    }

}
