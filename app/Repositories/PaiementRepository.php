<?php

namespace App\Repositories;

use App\Models\Paiement;
use App\Repositories\Repository;


class PaiementRepository extends Repository
{
    public function __construct(Paiement $model)
    {
        $this->model = $model;
    }

    public function ListPaiement()
    {
        $paiements = Paiement::select('id','references_paiements', 'montants', 'moyen_paiements', 'add_date')
            ->orderBy('add_date', 'DESC')
            ->where([
                ['is_deleted', 0],
                ['status', 0]
            ])
            ->get();
            
        return $paiements;
    }

}
