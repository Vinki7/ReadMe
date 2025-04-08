<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credentials extends Model
{
    use HasFactory;

    protected $table = 'credentials';
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string'; // UUIDs are strings

    protected $fillable = [
        'username',
        'password',
        'email',
        'last_login',
    ];

    protected $casts = [
        'last_login' => 'datetime',
    ];

    protected $attributes = [
        'username' => '',
        'password' => '',
        'email' => '',
    ];

}
