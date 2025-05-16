<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'action',
        'message',
    ];

    // Relationship: belongs to a vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    //To track who did the action
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
