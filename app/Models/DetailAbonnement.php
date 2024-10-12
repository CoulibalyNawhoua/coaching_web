<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAbonnement extends Model
{
    use HasFactory;
    protected $table = 'details_abonnements';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'id_abonnement',
        'id_offre',
    ];
    public $timestamps = false;
   
}
