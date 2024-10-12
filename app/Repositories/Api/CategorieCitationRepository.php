<?php

namespace App\Repositories\Api;

use App\Models\CategorieCitation;
use App\Models\Citation;
use App\Repositories\Repository;

class CategorieCitationRepository extends Repository
{
    public function __construct(CategorieCitation $model)
    {
        $this->model = $model;
    }

    public function listeCategorieCitations()
    {
        $ListCategorieCitation = CategorieCitation::where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        try {

            return response()->json([
                'data' => $ListCategorieCitation,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Echec de la connexion',
            ], 422);
        }
    }
    public function DetailsCategorie($categorieID)
    {
        $citations = CategorieCitation::with('citations')
            ->where([
                'id'=> $categorieID,
                'is_deleted' => 0 
                ])
            ->first(); // Utilisez 'first' pour obtenir un seul résultat

        if (!$citations) {
            return response([
                'message' => 'Catégorie non trouvée'
            ], 404);
        }

        return response([
            'data' => $citations
        ], 200);
    }
}