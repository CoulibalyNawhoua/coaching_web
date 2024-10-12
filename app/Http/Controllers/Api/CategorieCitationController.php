<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\CategorieCitationRepository;

class CategorieCitationController extends Controller
{
    private $categoriecitationRepository;

    public function __construct(CategorieCitationRepository $categoriecitationRepository)
    {
        $this->categoriecitationRepository = $categoriecitationRepository;
    }
    public function categorieCitations()
    {
        $categories = $this->categoriecitationRepository->listeCategorieCitations();
        
        return response()->json([
            'message' => 'toutes les citations ont été récupérées avec succès',
            'data' => $categories
        ],200);
    }

}
