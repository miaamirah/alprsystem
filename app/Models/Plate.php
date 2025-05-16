<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'plate_text',
        'entry_time',
        'exit_time',
        'flagged',
        'reason',
    ];

    public function logs()
    {
        return $this->hasMany(VehicleLog::class);
    }
}
