<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Tambah kolom hanya kalau belum ada
            if (!Schema::hasColumn('products', 'specifications')) {
                $table->json('specifications')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom hanya kalau memang ada
            if (Schema::hasColumn('products', 'specifications')) {
                $table->dropColumn('specifications');
            }
        });
    }
};
