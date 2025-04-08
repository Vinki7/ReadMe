<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Enums\Role;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    public $incrementing = false; // UUIDs are not auto-incrementing
    protected $keyType = 'string'; // UUIDs are strings

    protected $fillable = [
        'name',
        'surname',
        'role',
    ];

    protected $casts = [
        'role' => Role::class,
    ];
}
