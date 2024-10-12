<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieTicket extends Model
{
    use HasFactory;
    protected $table = 'categories_tickets';
    protected $primaryKey = "id";
    protected $fillable = [

        'name',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'deleted_by',
        'delete_date',
        'is_deleted',
    ];

    public $timestamps = false;
}
