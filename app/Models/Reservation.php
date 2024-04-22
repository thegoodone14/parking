<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID_reservation',
        'Date_heure_reservation',
        'Date_heure_expiration',
        'ID_Place',
        'ID_user',
        'created_at',
        'updated_at',
    ];

    // Définition de la table si elle n'utilise pas le nom par défaut
    protected $table = 'reservations';

    // Désactivation des timestamps si vous ne les utilisez pas
    public $timestamps = false;

    // La clé primaire si elle n'est pas 'id'
    protected $primaryKey = 'ID_reservation';

    // Définition de la relation avec la table users
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_user');
    }

    // Définition de la relation avec la table places
    public function place()
    {
        return $this->belongsTo(Place::class, 'ID_Place');
    }
    protected static function booted()
    {
        static::created(function ($reservation) {
            History::create([
                'reservation_id' => $reservation->ID_reservation,
                'action' => 'created',
                'details' => json_encode([
                    'Date_heure_reservation' => $reservation->Date_heure_reservation,
                    'Date_heure_expiration' => $reservation->Date_heure_expiration,
                    'ID_Place' => $reservation->ID_Place,
                    'ID_user' => $reservation->ID_user
                ])
            ]);
        });
    }

}
