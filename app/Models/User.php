<?php
namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'surname',
        'username',
        'email',
        'password',
        'role',
        'last_login',
    ];

    protected $casts = [
        'last_login' => 'datetime',
        'email_verified_at' => 'datetime',
        'role' => Role::class,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relationship with the Cart model.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    /**
     * Relationship with the Order model.
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'user_orders', 'user_id', 'order_id');
    }
}
