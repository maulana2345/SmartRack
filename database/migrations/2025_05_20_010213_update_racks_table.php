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
        {
        Schema::table('racks', function (Blueprint $table) {
            $table->dropColumn('lokasi_rak');
            $table->integer('jarak')->after('kapasitas_max');
            $table->integer('kapasitas_tersedia')->after('jarak');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('racks', function (Blueprint $table) {
            $table->string('lokasi_rak')->after('kapasitas_max');
            $table->dropColumn('jarak');
            $table->dropColumn('kapasitas_tersedia');
        });
    }
};
