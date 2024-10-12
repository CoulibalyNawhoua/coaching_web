<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategorieCitation extends Model
{
    use HasFactory;
    protected $table = 'categories';
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
    public function citations(): HasMany
    {
        return $this->hasMany(Citation::class);
    }
}
