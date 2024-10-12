<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\FavorieRepository;

class FavoriesController extends Controller
{
    private $favorisRepository;
    public function __construct(FavorieRepository $favorisRepository)
    {
        $this->favorisRepository = $favorisRepository;
    }
    public function likes(Request $request)
    {
        return $this->favorisRepository->StoreFavories($request);
    }
}
