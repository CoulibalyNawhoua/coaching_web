<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateEvent extends Model
{
    use HasFactory;
    protected $table = 'dates_evenements';
    protected $primaryKey = "id";
    protected $fillable = [

        'id',
        'id_events',
        'date_evenement',
        'heure_evenement',
        'adresse_event',
        'add_date',
        'added_by',
        'edited_by',
        'edit_date',
        'deleted_by',
        'delete_date',
        'is_deleted',

    ];

    public $timestamps = false;


    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'id_events','id');
    }
}
