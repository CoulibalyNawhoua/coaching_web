<?php

namespace App\Repositories;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;


class RoleRepository extends Repository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
    public function getDate()
    {
        date_default_timezone_set('Africa/Abidjan');
        return date_format(date_create(date('Ymd H:i:s')), 'Ymd H:i:s');
    }

    public function Store_Role(Request $request)
    {
        $input = $request->all();
        $role = new Role;
        $role->name = $input['name'];
        $role->added_by = Auth::user()->id;
        $role->add_date = Carbon::now();
        $role->save();
    }
    public function Liste_role()
    {
        $roles = Role::where('roles.is_deleted', 0)
            ->leftJoin('users', 'users.id', '=', 'roles.added_by')
            ->selectRaw('roles.name, roles.id, roles.add_date, roles.edit_date, users.first_name, users.last_name, users.email')
            ->orderBy('roles.id', 'DESC')
            ->get();
        return $roles;
    }

    public function update_role($request , $id){

        $role = $this->model->find($id);
        $role->name = $request->name;
        $role->edited_by = Auth::user()->id;
        $role->edit_date = Carbon::now();
        $role->update();
        return $role;
    }
    public function delete_role($id)
    {
        $role = $this->model->find($id);
        $role->is_deleted = 1;
        $role->deleted_by = Auth::user()->id;
        $role->delete_date = Carbon::now();
        $role->save();
    }
}
