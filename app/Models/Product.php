<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'is_promo',
        'is_featured',
        'condition',
        'specifications', // <-- jangan lupa ini
    ];

   protected $casts = [
    'specifications' => 'array',
];


   public function images()
{
    return $this->hasMany(ProductImage::class);
}


    public function mainImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_main', true);
    }
}
