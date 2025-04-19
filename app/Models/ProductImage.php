<?php

namespace App\Models;

use App\Enums\ImageType;
use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_id',
        'image_path',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getImagePath(): string
    {
        return $this->image_path;
    }

    public function getProductId(): string
    {
        return $this->product_id;
    }

    public function getType(): ImageType
    {
        $fileName = $this->extractFileName();

        $type = $this->defineType($fileName);

        return $type;
    }

    private function extractFileName(): string
    {
        $file = explode('/', $this->image_path)[3];
        $fileName = explode('.', $file)[0];

        return $fileName;
    }

    private function defineType(string $fileName): ImageType
    {
        if (str_contains($fileName, 'front')) {
            return ImageType::FrontCover;
        }

        if (str_contains($fileName, 'back')) {
            return ImageType::BackCover;
        }

        if (str_contains($fileName, 'full')) {
            return ImageType::FullBook;
        }

        if (str_contains($fileName, 'insights')) {
            return ImageType::BookInsights;
        }

        return ImageType::Other;
    }
}
