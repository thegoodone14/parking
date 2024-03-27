<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    use HasFactory;
    protected $table = 'waitlist';
    public $timestamps = false; // Si vous ne gérez pas les timestamps updated_at

    protected $fillable = ['user_id']; // Les champs que vous pouvez assigner massivement

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
