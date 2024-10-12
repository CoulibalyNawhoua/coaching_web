<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorie extends Model
{
    use HasFactory;
    protected $table = 'favories';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'id_citations',
        'id_inscription',
        'add_date',
    ];

    public $timestamps = false;
}
