<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurePassword extends Model
{
    use HasFactory;
    protected $table = 'reset_mot_passe';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'code',
        'phone',
        'add_date',
        'added_by',
        'edit_date',
        'edited_by',
    ];

    public $timestamps = false;
}
