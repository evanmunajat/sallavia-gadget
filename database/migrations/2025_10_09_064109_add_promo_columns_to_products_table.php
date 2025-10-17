<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // URL friendly
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->string('image')->nullable();
            $table->string('category')->nullable(); // opsional kategori
            $table->boolean('status')->default(true); // aktif/nonaktif
            $table->string('condition')->default('new'); // new / second
            $table->timestamps();
            $table->softDeletes(); // bisa di-undo hapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promos');
    }
};
