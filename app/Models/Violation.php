<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'violation_type',
        'amount',
        'status',
        'paid_at',
    ];
    
    protected $casts = [
        'paid_at' => 'datetime',
    ];
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'license_plate', 'license_plate');
    }

    /**
     * Get the formatted paid_at date
     *
     * @return string
     */
    public function getFormattedPaidAtAttribute()
    {
        if (!$this->paid_at) {
            return 'Not yet paid';
        }
        
        return Carbon::parse($this->paid_at)->format('F d, Y');
    }
    
    /**
     * Check if the violation is paid
     *
     * @return bool
     */
    public function isPaid()
    {
        return $this->status === 'paid' && $this->paid_at !== null;
    }
}