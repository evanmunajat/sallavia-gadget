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
    Schema::table('promos', function (Blueprint $table) {
        $table->string('condition')->default('new')->after('status'); // tambahkan setelah kolom status
    });
}

public function down(): void
{
    Schema::table('promos', function (Blueprint $table) {
        $table->dropColumn('condition');
    });
}

};
