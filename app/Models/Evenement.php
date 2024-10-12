<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;
    protected $table = 'evenements';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'titles',
        'descriptions',
        'url_images',
        'add_date',
        'added_by',
        'edit_by',
        'delete_by',
        'is_deleted',
        'status',

    ];

    public $timestamps = false;
    public function datesEvenement()
    {
        return $this->hasMany(DateEvent::class, 'id_events');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function getPremiereDateAttribute()
    {
        return $this->datesEvenement->min('date_evenement');
    }

    public function getDerniereDateAttribute()
    {
        return $this->datesEvenement->max('date_evenement');
    }

    public function getHeurePremiereDateAttribute()
    {
        return $this->datesEvenement->min('heure_evenement');
    }
    public function getHeureDerniereDateAttribute()
    {
        return $this->datesEvenement->max('heure_evenement');
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'id_events');
    }
}