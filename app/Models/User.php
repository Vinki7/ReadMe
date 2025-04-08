<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $keyType = 'string';
    public $incrementing = false;

    public function credential() {
        return $this->hasOne(Credential::class, 'id');
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function sessions() {
        return $this->hasMany(Session::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'user_orders');
    }
}
