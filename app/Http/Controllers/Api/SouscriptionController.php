<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Repositories\Api\SouscriptionRepository;

class SouscriptionController extends Controller
{
    private $souscriptionRepository;
    public function __construct(SouscriptionRepository $souscriptionRepository)
    {
        $this->souscriptionRepository = $souscriptionRepository;
    }

    public function SouscriptionAbonnement(Request $request)
    {
        return $this->souscriptionRepository->SouscriptionAbonnement($request);
    }
}
