<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CategorieTicket;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CategorieTicketRepository extends Repository
{

    public function __construct(CategorieTicket $model)
    {
        $this->model = $model;
    }

    public function StoreCategorieTicket(Request $request)
    {
        $categorie_ticket = CategorieTicket::create([

            'name' => $request->name,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);
        return $categorie_ticket;
    }

    public function Liste_CategorieTicket()
    {
        $categories_tickets = DB::select("SELECT categories_tickets.id , categories_tickets.name, categories_tickets.add_date, categories_tickets.edit_date, users.first_name, users.last_name, users.email
        FROM  categories_tickets INNER JOIN users ON categories_tickets.added_by = users.id AND categories_tickets.is_deleted = '0' ORDER BY categories_tickets.id DESC");

        return $categories_tickets;
    }
    public function update_CategorieTicket($request , $id){

        $categorie_ticket = $this->model->find($id);
        $categorie_ticket->name = $request->name;
        $categorie_ticket->edited_by = Auth::user()->id;
        $categorie_ticket->edit_date = Carbon::now();
        $categorie_ticket->update();
        return $categorie_ticket;
    }
    public function delete_CategorieTicket($id)
    {
        $categorie_ticket = $this->model->find($id);

        $categorie_ticket->is_deleted = 1;
        $categorie_ticket->deleted_by = Auth::user()->id;
        $categorie_ticket->delete_date = Carbon::now();
        $categorie_ticket->save();
    }


}
