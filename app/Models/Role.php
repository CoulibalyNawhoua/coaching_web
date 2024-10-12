<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';
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
}
