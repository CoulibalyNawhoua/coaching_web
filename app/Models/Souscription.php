<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{
    use HasFactory;
    protected $table = 'souscriptions';
    protected $primaryKey = "id";
    protected $fillable = [

        'id_inscription',
        'id_abonnement',
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

    public function paiementAbonnement()
    {
        return $this->hasOne(Paiement::class, 'id_souscription_abonnement', 'id');
    }
    public function abonnement()
{
    return $this->belongsTo(Abonnement::class, 'id_abonnement');
}

}
