<?php

namespace App\Repositories;

use App\Models\PeriodeAbonnement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;


class PeriodeAbonnementRepository extends Repository
{

    public function __construct(PeriodeAbonnement $model)
    {
        $this->model = $model;
    }

    public function StorePeriodeAbonnement(Request $request)
    {
        $periode_abonnement = PeriodeAbonnement::create([
            'periode'=> $request->periode,
            'added_by'=> Auth::user()->id,
            'add_date'=> Carbon::now(),
        ]);

        return $periode_abonnement;
    }
    public function Liste_PeriodeAbonnement()
    {
        $periodes_abonnements = PeriodeAbonnement::where('periode_abonnement.is_deleted', 0)
            ->leftJoin('users', 'users.id', '=', 'periode_abonnement.added_by')
            ->selectRaw('periode_abonnement.periode, periode_abonnement.id, periode_abonnement.add_date, periode_abonnement.edit_date, users.first_name, users.last_name, users.email')
            ->orderBy('periode_abonnement.id', 'DESC')
            ->get();

        return $periodes_abonnements;
    }
    public function update_PeriodeAbonnement($request , $id){

        $periode_abonnement = $this->model->find($id);
        $periode_abonnement->periode = $request->periode;
        $periode_abonnement->edited_by = Auth::user()->id;
        $periode_abonnement->edit_date = Carbon::now();
        $periode_abonnement->update();

        return $periode_abonnement;
    }

    public function delete_periode($id)
    {
        $periode_abonnement = $this->model->find($id);

        $periode_abonnement->is_deleted = 1;
        $periode_abonnement->deleted_by = Auth::user()->id;
        $periode_abonnement->delete_date = Carbon::now();
        $periode_abonnement->save();
    }
}
