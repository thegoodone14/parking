<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_place',
        'numero',
        'created_at',
        'updated_at',
    ];

    protected $table = 'places';
    public $timestamps = false;
    protected $primaryKey = 'id_place';

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_place');
    }
}