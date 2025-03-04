<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function typeCreatedBy()
    {
        return $this->hasMany(Type::class, 'created_by');
    }
    
    public function typeUpdatedBy()
    {
        return $this->hasMany(Type::class, 'updated_by');
    }

    public function itemCreatedBy()
    {
        return $this->hasMany(Item::class, 'created_by');
    }
    
    public function itemUpdatedBy()
    {
        return $this->hasMany(Item::class, 'updated_by');
    }
}
