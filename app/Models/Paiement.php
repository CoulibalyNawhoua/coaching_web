<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;
    protected $table = 'paiements';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'references_paiements',
        'id_achat_ticket',
        'id_souscription_abonnement',
        'montants',
        'moyen_paiements',
        'status',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'deleted_by',
        'is_deleted',
        'delete_date',
    ];

    public $timestamps = false;
}
