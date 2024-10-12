<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory;
    protected $table = 'galeries';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'id_citations',
        'url_medias',
        'types_fichiers',
        'added_by',
        'edited_by',
        'delete_by',
        'is_deleted',
        'add_date',
        'edit_date',
    ];

    public $timestamps = false;

    public function citations()
    {
        return $this->belongsTo(Citation::class, 'id_citations', 'id');
    }
}
