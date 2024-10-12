<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\AbonnementRepository;

class AbonnementController extends Controller
{
    private $abonnementRepository;
    public function __construct(AbonnementRepository $abonnementRepository)
    {
        $this->abonnementRepository = $abonnementRepository;
    }
    public function ListeAbonnement()
    {
        return $this->abonnementRepository->ListeAbonnement();
    }

    public function DetailsAbonnement($abonID)
    {
        return $this->abonnementRepository->DetailsAbonnement($abonID);
    }
    public function SouscriptionAbonnement(Request $request)
    {
        return $this->abonnementRepository->SouscriptionAbonnement($request);
    }
    public function updateStatus($paiementId,$souscriptionId)
    {
        return $this->abonnementRepository->updatePaiement($paiementId,$souscriptionId);
    }
    public function verifierAbonnement()
    {
        return $this->abonnementRepository->verifierAbonnement();
    }
    public function getAccesUtilisateur()
    {
        return $this->abonnementRepository->getAccesUtilisateur();
    }
    public function userAbonnement()
    {
        return $this->abonnementRepository->userAbonnement();
    }
    // public function detailsAbonnementUtilisateur()
    // {
    //     return $this->abonnementRepository->detailsAbonnementUtilisateur();
    // }

}
