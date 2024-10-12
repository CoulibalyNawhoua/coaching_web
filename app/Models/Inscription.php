<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Inscription extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'inscriptions';
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'url_photo',
        'adresse',
        'genre',
        'status',
        'phone',
        'password',
        'password_confirmation',
        'add_date',
        'edit_date',
        'edited_by',
        
   ];
    public $timestamps = false;
    protected $hidden = [
        'password',
        'remember_token',
        'password_confirmation'
    ];

    public function abonnement()
    {
        return $this->hasOne(Abonnement::class, 'id_inscription', 'id');
    }
    public function souscription()
    {
        return $this->hasOne(Souscription::class, 'id_inscription', 'id');
    }
}
