<?php

namespace App\Repositories\Api;



use App\Models\CategorieCitation;
use App\Models\Citation;
use App\Models\Galerie;
use App\Repositories\Repository;

class CitationRepository extends Repository
{
    public function __construct(Citation $model)
    {
        $this->model = $model;
    }
    public function listeCitations()
    {
        // $citations = Citation::leftJoin('galeries', 'galeries.id_citations', '=', 'citations.id')
        // ->select('citations.id','citations.contenu', 'galeries.url_medias')
        // ->get();
        // return $citations;
        return Citation::where('is_deleted', 0)->select('contenu')->orderBy('add_date', 'DESC')->get();
    }

    public function CitationCategorie($CategoryId)
    {
        
        $citationsCategorie = CategorieCitation::find($CategoryId);

        $CitationsCategorie = Citation::where([
            ["id_categorie_citations", $citationsCategorie->id],
            ['citations.is_deleted', 0],
        ])
        ->select('contenu')
        ->orderBy('add_date', 'DESC')
        ->get();

        return $CitationsCategorie;

    }


    public function detailCitations($id)
    {
        $citation = $this->model->find($id);

        if (!$citation) {
            return response()->json([
                'status' => 404,
                'message' => 'Citation non trouvée',
            ]);
        }

        $details = Galerie::where([
            ['galeries.id_citations', $citation->id],
            ['citations.is_deleted', 0],
        ])
            ->leftJoin('citations', 'citations.id', '=', 'galeries.id_citations')
            ->select('citations.contenu', 'citations.id_categorie_citations', 'galeries.url_medias', 'galeries.types_fichiers', 'galeries.id')
            ->get();

        return response()->json([
            'message' => 'Détails de la citation récupérés avec succès',
            'data' => $details,
        ], 200);
    }

}