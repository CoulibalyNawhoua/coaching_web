<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'references_tickets',
        'libelle',
        'id_events',
        'id_date_event',
        'id_categories_tickets',
        'added_by',
        'add_date',
        'edited_by',
        'edit_date',
        'delete_by',
        'delete_date',
        'is_deleted',
        'status',
        'prix_tickets',
        'quantite_tickets',
        'taux_reduction',
    ];

    public $timestamps = false;

    public function dateEvent()
    {
        return $this->belongsTo(DateEvent::class, 'id_date_event', 'id');
    }
    public function evenement()
    {
        return $this->belongsTo(Evenement::class, 'id_events', 'id');
    }
    public function category()
    {
        return $this->belongsTo(CategorieTicket::class, 'id_categories_tickets', 'id');
    }
    
}