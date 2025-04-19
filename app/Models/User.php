<?php
namespace App\Models;

use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

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

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->id)) {
            $model->id = (string) Str::uuid();
        }
    });
}

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

    public function assignRole(Role $role): void
    {
        $this->role = $role;
        $this->save();
    }
}
