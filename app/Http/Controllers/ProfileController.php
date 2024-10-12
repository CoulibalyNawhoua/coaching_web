<?php

namespace App\Http\Controllers;

use App\Repositories\InscriptionRepository;
use App\Repositories\AbonnementRepository;
use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class ProfileController extends Controller
{
    private $inscriptionRepository;
    private $abonnementRepository;
    private $userRepository;

    public function __construct(
        AbonnementRepository $abonnementRepository,
        InscriptionRepository $inscriptionRepository,
        UserRepository $userRepository,
    )
    {
        $this->abonnementRepository = $abonnementRepository;
        $this->inscriptionRepository = $inscriptionRepository;
        $this->userRepository = $userRepository;
    }
    public function index_profile()
    {
        $userSouscrits = $this->abonnementRepository->countUsersSouscrits();
        $userInscrits = $this->inscriptionRepository->userInscrits();
        $userInfo = $this->userRepository->userInfo();
        return view('admin.profile.profile',compact('userSouscrits','userInscrits','userInfo'));
    }

    public function edit_profile(Request $request): View
    {
        $userId= Auth::user();
        $userSouscrits = $this->abonnementRepository->countUsersSouscrits();
        $userInscrits = $this->inscriptionRepository->userInscrits();
        return view('admin.profile.profile', compact('userId','userSouscrits','userInscrits'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
