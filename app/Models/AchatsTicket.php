<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchatsTicket extends Model
{
    use HasFactory;
    protected $table = 'achats_tickets';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'references_achats',
        'id_inscriptions',
        'id_tickets',
        'quantity',
        'montants_paye',
        'added_by',
        'add_date',
        'eddited_by',
        'edit_date',
        'deleted_by',
        'delete_date',
        'is_deleted',
        'status',
    ];
    public $timestamps = false;

    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'id', 'id_achat_ticket');
    }
 
}


