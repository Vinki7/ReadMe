<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function users() {
        return $this->belongsToMany(User::class, 'user_orders');
    }

    public function orderHistories() {
        return $this->hasMany(OrderHistory::class);
    }
}
