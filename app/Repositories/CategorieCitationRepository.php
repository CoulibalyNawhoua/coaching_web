<?php

namespace App\Repositories;

use App\Models\CategorieCitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;


class CategorieCitationRepository extends Repository
{

    public function __construct(CategorieCitation $model)
    {
        $this->model = $model;
    }

    public function getDate()
    {
        date_default_timezone_set('Africa/Abidjan');
        return date_format(date_create(date('Ymd H:i:s')), 'Ymd H:i:s');
    }

    public function StoreCategorieCitation(Request $request)
    {
        $categorie_citation = CategorieCitation::create([
            'name'=> $request->name,
            'added_by'=> Auth::user()->id,
            'add_date'=> Carbon::now(),
        ]);

        return $categorie_citation;
    }

    public function Liste_CategorieCitation()
    {
        $categorie_citation = CategorieCitation::where('categories.is_deleted', 0)
            ->leftJoin('users', 'users.id', '=', 'categories.added_by')
            ->selectRaw('categories.name, categories.id, categories.add_date, categories.edit_date, users.first_name, users.last_name, users.email')
            ->orderBy('categories.id', 'DESC')
            ->get();

        return $categorie_citation;
    }

    public function update_CategorieCitation($request , $id){

        $categorie_citation = $this->model->find($id);
        $categorie_citation->name = $request->name;
        $categorie_citation->edited_by = Auth::user()->id;
        $categorie_citation->edit_date = Carbon::now();
        $categorie_citation->update();
        return $categorie_citation;
    }

    public function delete_categorie($id)
    {
        $categorie = $this->model->find($id);

        $categorie->is_deleted = 1;
        $categorie->deleted_by = Auth::user()->id;
        $categorie->delete_date = Carbon::now();
        $categorie->save();
    }
}
