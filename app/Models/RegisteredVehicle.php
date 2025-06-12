<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'student_id',
        'plate_text',
        'vehicle_type',   
        'brand',
        'color',
    ];

    public function plate()
    {
        return $this->belongsTo(Plate::class, 'plate_text', 'plate_text');
    }
}
