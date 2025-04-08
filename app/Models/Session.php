<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
