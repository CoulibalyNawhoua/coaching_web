<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieAbonnement extends Model
{
    use HasFactory;
    protected $table = 'categories_abonnements';
    protected $primaryKey = "id";
    protected $fillable = [

        'name',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'deleted_by',
        'is_deleted',
        'delete_date',
    ];
    public $timestamps = false;
    // public function abonnements()
    // {
    //     return $this->hasMany(Abonnement::class, 'id_categorie_abonnement');
    // }


}
