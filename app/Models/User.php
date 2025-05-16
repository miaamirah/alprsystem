<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',       
        'approved',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'approved' => 'boolean',
        ];
    }

    // A user can perform many log actions
    public function logs()
    {
        return $this->hasMany(VehicleLog::class);
    }
    // A user (Admin) can generate many reports
    public function reports()
    {
        return $this->hasMany(Report::class, 'generated_by');
    }
}
