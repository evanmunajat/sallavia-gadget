<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom is_main kalau tabel sudah ada
        if (Schema::hasTable('new_arrival_images') && !Schema::hasColumn('new_arrival_images', 'is_main')) {
            Schema::table('new_arrival_images', function (Blueprint $table) {
                $table->boolean('is_main')->default(false)->after('image');
            });
        }
    }

    public function down(): void
    {
        // Hapus kolom is_main jika ada
        if (Schema::hasColumn('new_arrival_images', 'is_main')) {
            Schema::table('new_arrival_images', function (Blueprint $table) {
                $table->dropColumn('is_main');
            });
        }
    }
};

