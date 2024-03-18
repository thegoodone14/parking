<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    
     // Définition de la table si elle n'utilise pas le nom par défaut
     protected $table = 'places';

     // Désactivation des timestamps si vous ne les utilisez pas
     public $timestamps = false;
 
     // La clé primaire si elle n'est pas 'id'
     protected $primaryKey = 'ID_Place';
 
     // Définition de la relation avec la table reservations
     public function reservations()
     {
         return $this->hasMany(Reservation::class, 'ID_Place');
     }
}
