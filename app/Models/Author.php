<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'surname',
        'birth_date',
        'biography',
    ];

    protected $casts = [
        'id' => 'string',
        'birth_date' => 'date',
    ];

    /**
     * Relationship with the Product model (many-to-many).
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_author', 'author_id', 'product_id');
    }
}
