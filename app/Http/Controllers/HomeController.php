<?php

namespace App\Http\Controllers;

use App\Repositories\AbonnementRepository;
use App\Repositories\EventRepository;
use App\Repositories\InscriptionRepository;
use App\Repositories\RepositoryCitation;

class HomeController extends Controller
{
    private $citationRepository;
    private $abonnementRepository;
    private $inscriptionRepository;
    private $eventRepository;

    public function __construct(
        RepositoryCitation $citationRepository,
        AbonnementRepository $abonnementRepository,
        InscriptionRepository $inscriptionRepository,
        EventRepository $eventRepository
    )
    {
        $this->citationRepository = $citationRepository;
        $this->abonnementRepository = $abonnementRepository;
        $this->inscriptionRepository = $inscriptionRepository;
        $this->eventRepository = $eventRepository;
    }
   
    public function index()
    {
        $citationTotal = $this->citationRepository->countCitationsPubliees();
        $userSouscrits = $this->abonnementRepository->countUsersSouscrits();
        $userInscrits = $this->inscriptionRepository->userInscrits();
        $totalEvent = $this->eventRepository->nbreEvent();
        return view('dashboard',compact('citationTotal','userSouscrits','userInscrits','totalEvent'));
    }

    
}
