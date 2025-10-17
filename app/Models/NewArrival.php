<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'condition',
        'specifications',
    ];

    /**
     * Casting otomatis dari JSON ke array.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specifications' => 'array',
    ];

    /**
     * Relasi ke tabel gambar tambahan (new_arrival_images).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
public function images()
{
    return $this->hasMany(NewArrivalImage::class, 'newarrival_id');
}


public function getMainImageAttribute()
{
    return $this->images ? $this->images->firstWhere('is_main', true) : null;
}


    /**
     * Helper untuk memastikan specifications selalu dikembalikan sebagai array.
     *
     * @return array
     */
    public function getSpecificationsArray(): array
    {
        // Kalau sudah array, langsung return
        if (is_array($this->specifications)) {
            return $this->specifications;
        }

        // Kalau masih string JSON, decode dulu
        if (is_string($this->specifications)) {
            $decoded = json_decode($this->specifications, true);
            return is_array($decoded) ? $decoded : [];
        }

        // Kalau null atau format lain, kembalikan array kosong
        return [];
    }

    /**
     * Helper opsional buat ngecek apakah ada gambar utama.
     *
     * @return string|null
     */
    public function getMainImageUrl(): ?string
    {
        $mainImage = $this->images()->where('is_main', true)->first();

        if ($mainImage) {
            return asset('storage/' . $mainImage->image);
        }

        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        

        // fallback placeholder
        return 'https://via.placeholder.com/600x400?text=No+Image';
    }
}
