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
        Schema::table('new_arrivals', function (Blueprint $table) {
            $table->string('condition')->default('new')->after('price'); 
            // Bisa 'new' atau 'second'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_arrivals', function (Blueprint $table) {
            $table->dropColumn('condition');
        });
    }
};
