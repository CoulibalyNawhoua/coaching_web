<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonnement extends Model
{
    use HasFactory;
    protected $table = 'abonnements';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'references_abonnements',
        'libelle',
        'id_categories_abonnements',
        'id_dure_abonnement',
        'prix_abonnements',
        'added_by',
        'add_date',
        'edited_by',
        'edit_date',
        'delete_by',
        'is_deleted',
        'delete_date',
        'status',
    ];
    public $timestamps = false;
public function offresAbonnement()
{
    return $this->belongsToMany(OffreAbonnement::class, 'details_abonnements', 'id_abonnement', 'id_offre');
}

    public function periodeAbonnement()
    {
        return $this->belongsTo(PeriodeAbonnement::class, 'id_dure_abonnement');
    }
}
