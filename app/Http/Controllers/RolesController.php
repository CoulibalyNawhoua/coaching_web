<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RolesController extends Controller
{
    private $rolesRepository;
    public function __construct(RoleRepository $rolesRepository)
    {

        $this->rolesRepository = $rolesRepository;
    }
    public function index()
    {
        $Liste_roles = $this->rolesRepository->Liste_role();
        return view('admin.pages.roles.index', compact('Liste_roles'));
    }
    public function store(Request $request)
    {
        $this->rolesRepository->store_Role($request);
        return response()->json(['code' => 200, 'success' => 'Enregistrement éffectué avec succès ']);
        //    return redirect()->back();

    }
    public function edit($id)
    {
        $role = $this->rolesRepository->edit($id);
        return view('admin.pages.roles.edit', compact('role'));
    }
    public function update(Request $request, string $id)
    {
        $this->rolesRepository->update_role($request, $id);
        return redirect('/roles')->with('success', 'Modification effectuée avec succès!');

    }
    public function delete_role(Request $request)
    {
        $id = $request->role_id;
        $this->rolesRepository->delete_role($id);

        return response()->json($id);
    }
    public function test(){
        return view('admin.pages.roles.test');
    }
}
