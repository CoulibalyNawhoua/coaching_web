<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreAbonnement extends Model
{
    use HasFactory;
    protected $table = 'offres_abonnements';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'offres',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'is_deleted',
        'deleted_by',
        'delete_date',
    ];
    public $timestamps = false;
    public function abonnements()
    {
        return $this->belongsToMany(Abonnement::class, 'details_abonnements', 'id_offre', 'id_abonnement');
    }
}
