<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeAbonnement extends Model
{
    use HasFactory;
    protected $table = 'periode_abonnement';
    protected $primaryKey = "id";
    protected $fillable = [
        'periode',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'deleted_by',
        'is_deleted',
        'delete_date',
    ];
    public $timestamps = false;

    public function abonnements()
    {
        return $this->hasMany(Abonnement::class, 'id_dures_abonnements');
    }
}
