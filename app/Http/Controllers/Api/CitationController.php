<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\CitationRepository;

class CitationController extends Controller
{
    private $citationRepository;
    public function __construct(CitationRepository $citationRepository)
    {
        $this->citationRepository = $citationRepository;
    }
    public function listeCitations()
    {

        $data = $this->citationRepository->listeCitations();

        if ($data) {
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Echec récupération',
            ], 422);

        }


    }
    public function CitationsCategorie($CategoryId)
    {
        $data = $this->citationRepository->CitationCategorie($CategoryId);

        if ($data) {
            return response()->json([
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Echec récupération',
            ], 422);

        }

    }
}