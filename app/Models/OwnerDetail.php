<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_number',
        'address',
        'vehicle_id',
        'license_image_link',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function violations(){
       return $this->hasManyThrough(
        Violation::class,    // Target model
        Vehicle::class,      // Intermediate model
        'id',                // Foreign key on vehicles table for owner_details
        'license_plate',     // Foreign key on violations table for vehicles
        'id',                // Local key on owner_details
        'license_plate'      // Local key on vehicles
    );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}