<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function products() {
        return $this->belongsToMany(Product::class, 'product_authors');
    }
}
