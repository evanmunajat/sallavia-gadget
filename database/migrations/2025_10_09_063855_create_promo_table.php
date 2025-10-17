<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // relasi ke products
            $table->string('promo_name')->nullable(); // nama promo
            $table->decimal('discount', 10, 2)->nullable(); // diskon jika ada
            $table->boolean('is_featured')->default(false); // unggulan
            $table->boolean('is_promo')->default(false); // promo
            $table->dateTime('starts_at')->nullable(); // mulai promo
            $table->dateTime('ends_at')->nullable();   // berakhir promo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
