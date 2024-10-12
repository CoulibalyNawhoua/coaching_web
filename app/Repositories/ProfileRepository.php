<?php

namespace App\Repositories;


use App\Models\Evenement;
use App\Repositories\Repository;



class ProfileRepository extends Repository
{
    public function __construct(Evenement $model)
    {
        $this->model = $model;
    }


}
