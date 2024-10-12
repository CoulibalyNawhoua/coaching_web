<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'titre',
        'libelle',
        'description',
        'add_by',
        'edit_by',
        'delete_by',
        'is_deleted',
        'status',
        'created_at',
        'updated_at',
    ];

}
