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
        Schema::table('banners', function (Blueprint $table) {
            // Cek dulu kalau kolom belum ada, baru tambah
            if (!Schema::hasColumn('banners', 'button_text')) {
                $table->string('button_text')->nullable()->after('image');
            }

            if (!Schema::hasColumn('banners', 'button_link')) {
                $table->string('button_link')->nullable()->after('button_text');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            if (Schema::hasColumn('banners', 'button_text')) {
                $table->dropColumn('button_text');
            }

            if (Schema::hasColumn('banners', 'button_link')) {
                $table->dropColumn('button_link');
            }
        });
    }
};
