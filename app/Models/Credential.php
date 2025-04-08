<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credential extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}
