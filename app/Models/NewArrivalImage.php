<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewArrivalImage extends Model
{
    use HasFactory;

    protected $fillable = ['newarrival_id', 'image', 'is_main'];

   public function newarrival()
{
    return $this->belongsTo(NewArrival::class, 'newarrival_id');
}


}
