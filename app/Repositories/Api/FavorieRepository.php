<?php

namespace App\Repositories\Api;


use Carbon\Carbon;
use App\Models\Favorie;
use Illuminate\Http\Request;
use App\Repositories\Repository;



class FavorieRepository extends Repository
{

    public function __construct(Favorie $model)
    {
        $this->model = $model;
    }
    public function StoreFavories(Request $request)
    {
        $favories = Favorie::create([
            'id_citations' => $request->id_citations,
            'id_inscription' => auth()->user()->id,
            'add_date' => Carbon::now(),

        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Ajout éffectué avec succès',
            'data' => $favories,
        ]);
    }

}
