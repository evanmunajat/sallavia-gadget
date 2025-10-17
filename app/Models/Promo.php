<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'slug',
        'category',
        'condition', // New / Second
        // 'is_promo',
        // 'is_featured',
    ];

    // Generate slug otomatis sebelum disimpan
    protected static function booted()
    {
        static::creating(function ($promo) {
            $promo->slug = Str::slug($promo->name) . '-' . time();
        });
    }
}
