<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\OffreAbonnement;
use App\Repositories\Repository;
use App\Models\CategorieAbonnement;
use Illuminate\Support\Facades\Auth;



class OffresAbonnementRepository extends Repository
{

    public function __construct(OffreAbonnement $model)
    {
        $this->model = $model;
    }
    public function ListeCategorieAbonnement()
    {
        $categories_abonnements = CategorieAbonnement::where('is_deleted', 0)->get();
        return $categories_abonnements;
    }
    public function StoreOffresAbonnement(Request $request)
    {
        $request->validate([
            'offres' => 'required',
        ]);

        $offresAbonnement = OffreAbonnement::create([
            'offres' => $request->offres,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);

        return $offresAbonnement;
    }
    public function ListeOffresAbonnement()
    {
        $offres_abonnements = OffreAbonnement::where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        return $offres_abonnements;
    }
    public function updateOffresAbonnement(Request $request, $id)
    {
        $offre = $this->model->find($id);
        $offre->update([
            'offres' => $request->offres,
            'edited_by' => Auth::user()->id,
            'edit_date' => Carbon::now(),
        ]);
        return $offre;
    }
    public function deleteOffre($id)
    {
        $offre = $this->model->find($id);

        $offre->is_deleted = 1;
        $offre->deleted_by = Auth::user()->id;
        $offre->delete_date = Carbon::now();
        $offre->save();
    }

}
