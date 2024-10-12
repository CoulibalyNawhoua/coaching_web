<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\CategorieAbonnement;
use Illuminate\Support\Facades\Auth;


class CategorieAbonnementRepository extends Repository
{

    public function __construct(CategorieAbonnement $model)
    {
        $this->model = $model;
    }

    public function getDate()
    {
        date_default_timezone_set('Africa/Abidjan');
        return date_format(date_create(date('Ymd H:i:s')), 'Ymd H:i:s');
    }

    public function StoreCategorieAbonnement(Request $request)
    {
        $categorie_abonnement = CategorieAbonnement::create([
            'name'=> $request->name,
            'added_by'=> Auth::user()->id,
            'add_date'=> Carbon::now(),
        ]);

        return $categorie_abonnement;
    }
    public function Liste_CategorieAbonnement()
    {
        $categories_abonnements = CategorieAbonnement::where('categories_abonnements.is_deleted', 0)
            ->leftJoin('users', 'users.id', '=', 'categories_abonnements.added_by')
            ->selectRaw('categories_abonnements.name, categories_abonnements.id, categories_abonnements.add_date, categories_abonnements.edit_date, users.first_name, users.last_name, users.email')
            ->orderBy('categories_abonnements.id', 'DESC')
            ->get();

        return $categories_abonnements;
    }
    public function update_CategorieAbonnement($request , $id){

        $categorie_abonnement = $this->model->find($id);
        $categorie_abonnement->name = $request->name;
        $categorie_abonnement->edited_by = Auth::user()->id;
        $categorie_abonnement->edit_date = Carbon::now();
        $categorie_abonnement->update();

        return $categorie_abonnement;
    }

    public function delete_abonnement($id)
    {
        $categorie_abonnement = $this->model->find($id);

        $categorie_abonnement->is_deleted = 1;
        $categorie_abonnement->deleted_by = Auth::user()->id;
        $categorie_abonnement->delete_date = Carbon::now();
        $categorie_abonnement->save();
    }
}
