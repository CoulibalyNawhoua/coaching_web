<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\InscriptionRequest;
use App\Repositories\InscriptionRepository;

class InscriptionController extends Controller
{
    private $inscriptionRepository;
    public function __construct(InscriptionRepository $inscriptionRepository)
    {
        $this->inscriptionRepository = $inscriptionRepository;
    }
    public function register(InscriptionRequest $request)
    {
        return $this->inscriptionRepository->Inscription($request);
    }
    public function signup(ConnexionRequest $request)
    {
        return $this->inscriptionRepository->signup($request);
        
    }
    public function checkAbonnement(Request $request)
    {
        return $this->inscriptionRepository->checkAbonnement($request);
    }
    
}