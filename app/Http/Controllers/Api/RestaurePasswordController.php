<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\RestaurePasswordRepository;

class RestaurePasswordController extends Controller
{
    private $restaurerPasswordRepository;
    public function __construct(RestaurePasswordRepository $restaurerPasswordRepository)
    {
        $this->restaurerPasswordRepository = $restaurerPasswordRepository;
    }

    public function RestaurePassword(Request $request)
    {
        return $this->restaurerPasswordRepository->restore_password($request);
    }
    public function UpdatePassword(Request $request)
    {
        return $this->restaurerPasswordRepository->restoreupdate_password($request);
    }
}
