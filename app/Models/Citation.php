<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    use HasFactory;

    protected $table = 'citations';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'contenu',
        'id_categorie_citations',
        'added_by',
        'edited_by',
        'edit_date',
        'delete_by',
        'is_deleted',
        'delete_date',
        'add_date',
    ];

    public $timestamps = false;

    public function categorieCitation()
    {
        return $this->belongsTo(CategorieCitation::class);
    }
    public function galerie()
    {
        return $this->belongsTo(Galerie::class, 'id_citations', 'id');
    }
}
