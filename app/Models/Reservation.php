<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_reservation',
        'date_heure_reservation',
        'date_heure_expiration',
        'id_place',
        'id_user',
        'created_at',
        'updated_at',
    ];

    protected $table = 'reservations';
    public $timestamps = false;
    protected $primaryKey = 'id_reservation';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'id_place');
    }

    protected static function booted()
    {
        static::created(function ($reservation) {
            History::create([
                'reservation_id' => $reservation->id_reservation,
                'action' => 'created',
                'details' => json_encode([
                    'date_heure_reservation' => $reservation->date_heure_reservation,
                    'date_heure_expiration' => $reservation->date_heure_expiration,
                    'id_place' => $reservation->id_place,
                    'id_user' => $reservation->id_user
                ])
            ]);
        });

        static::deleting(function ($reservation) {
            History::create([
                'reservation_id' => $reservation->id_reservation,
                'action' => 'deleted',
                'details' => json_encode($reservation->attributesToArray()),
            ]);
        });
    }
}