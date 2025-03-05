<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    use HasFactory;
    
    protected $table = 'waitlist';
    public $timestamps = false;
    protected $fillable = ['user_id', 'rang', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}