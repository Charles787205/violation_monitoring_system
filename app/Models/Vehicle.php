<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'make',
        'model',
        'year',
        'user_id',
        'photo_link', // Added photo link
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}