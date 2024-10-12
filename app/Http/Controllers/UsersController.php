<?php

namespace App\Http\Controllers;

use App\Repositories\InscriptionRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UsersController extends Controller
{
    private $userRepository;
    private $inscriptionRepository;

    public function __construct(
        UserRepository $userRepository,
        InscriptionRepository $inscriptionRepository
    ) 
    {
        $this->userRepository = $userRepository;
        $this->inscriptionRepository = $inscriptionRepository;
    }
    public function index()
    {
        $roles = $this->userRepository->all_role();
        $all_users = $this->userRepository->ListUser();
        return view('admin.pages.users.index',compact('roles','all_users'));
    }
    public function store(Request $request)
    {
        // Session::flash('message', 'This is a message!');
        $this->userRepository->StoreUser($request);
        // vos identifiant sont incorrect

        return redirect()->back();
    }
    public function edit(string $id)
    {
        $roles = $this->userRepository->all_role();
        $user = $this->userRepository->edit($id);
        return view('admin.pages.users.edit', compact('user', 'roles'));
    }
    public function update(Request $request, string $id)
    {
        $this->userRepository->update_user($request, $id);
        return  redirect('/users')->with('success', 'Modification effectuée avec succès!');
    }
    public function delete_user(Request $request)
    {
        $id = $request->user_id;
        $this->userRepository->delete_user($id);

        return response()->json($id);
    }
    public function listUserInscrits()
    {
        $listeUserInscrits = $this->inscriptionRepository->listUserInscrits();
        return view('admin.pages.inscriptions.index', compact('listeUserInscrits'));
    }
    
}
