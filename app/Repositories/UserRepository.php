<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository extends Repository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function all_role()
    {
        $roles = Role::where('is_deleted', 0)->get();
        return $roles;
    }
    public function StoreUser(Request $request)
    {
        $request->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:users|required',
            'phone' => 'required|regex:/^(\+225)[0-9]{8}$/|min:10',
            'password' => 'min:8|requiredrequired',
            'id_role' => 'required|array',
        ]);

        $user = User::create([
            'id_role' => $request->id_role,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);

        return $user;
    }

    public function ListUser()
    {
        $users = User::where('users.is_deleted', '=', 0)
            ->leftJoin('roles', 'roles.id', '=', 'users.id_role')
            ->selectRaw('roles.name, users.id, users.add_date, users.edit_date, users.first_name, users.last_name, users.email, users.phone, users.avatar_url')
            ->orderBy('users.id', 'DESC')
            ->get();
        return $users;
    }
    public function update_user($request, $id)
    {
        $user = $this->model->find($id);
        $input = $request->all();

        if ($request->hasFile('avatar_url')) {
            $path = Storage::disk('public')->putFile('avatars', $request->file('avatar_url'), 'public');
            $user->avatar_url = $path;
        } else {
            $user->avatar_url = null;
        }
        ;
        $user->update(['password' => Hash::make($input['password'])]);
        $user->phone = $request->phone;
        $user->id_role = $request->id_role;
        $user->edited_by = Auth::user()->id;
        $user->edit_date = Carbon::now();
        $user->update($input);

        return $user;
    }
    public function delete_user($id)
    {
        $user = $this->model->find($id);
        $user->is_deleted = 1;
        $user->deleted_by = Auth::user()->id;
        $user->delete_date = Carbon::now();
        $user->save();
    }

    public function userInfo()
    {
        $user = Auth::user();
        if ($user) {
            $userData = [
                // 'role' => $user->role->name,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'avatar_url' => $user->avatar_url,
            ];
            return $userData;
        }
    }
}
