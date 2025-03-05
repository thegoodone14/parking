<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'password',
        'statut',  // Corrigé la typo 'satut'
        'rang_attente',
        'est_bloque',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_user');
    }

    public function waitlistEntries()
    {
        return $this->hasMany(Waitlist::class, 'user_id');
    }
}