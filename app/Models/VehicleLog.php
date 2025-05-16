<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_id',
        'action',
        'message',
    ];

    // Relationship: belongs to a vehicle plate
    public function plate()
    {
        return $this->belongsTo(Plate::class, 'plate_id');
    }

    //To track who did the action
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
