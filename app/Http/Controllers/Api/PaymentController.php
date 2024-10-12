<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\PaiementRepository;

class PaymentController extends Controller
{
    private $paiementRepository;  
    public function __construct(PaiementRepository $paiementRepository)
    {
        $this->paiementRepository = $paiementRepository;
    }


}
