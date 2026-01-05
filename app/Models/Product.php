<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function getImageUrlAttribute()
    {
        if ($this->image === 'default-product.jpg') {
            return '/default-product.jpg';
        }
        
        return Storage::disk('public')->exists($this->image) 
            ? Storage::disk('public')->url($this->image)
            : '/default-product.jpg';
    }
}