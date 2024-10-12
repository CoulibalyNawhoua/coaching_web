<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Api\ProfileRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $profileRepository;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function updateUserProfile(Request $request, $id)
    {
        return $this->profileRepository->updateUserProfile($request,$id);
    }
    public function userInfos()
    {
        return $this->profileRepository->user();
    }

    // public function UpdateProfile(Request $request, $id)
    // {
    //     return $this->profileRepository->UpdateProfile($request, $id);
    // }

}
