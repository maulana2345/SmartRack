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
        // Users table (pengguna)
        Schema::create('user', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_pengguna');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('user');
            $table->timestamps();
        });

        // Activity logs (log_aktivitas)
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id('id');
            $table->string('aksi');
            $table->timestamp('waktu_aksi');
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->timestamps();
        });

        // Racks table (rak)
        Schema::create('racks', function (Blueprint $table) {
            $table->id('id');
            $table->string('kode_rak')->unique();
            $table->integer('kapasitas_max');
            $table->string('lokasi_rak');
            $table->timestamps();
        });

        // Items table (barang)
        Schema::create('items', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_barang');
            $table->string('kategori');
            $table->integer('stok');
            $table->string('ukuran');
            $table->float('berat');
            $table->timestamps();
        });

        // Storage details table (detail_penyimpanan)
        Schema::create('storage_details', function (Blueprint $table) {
            $table->id('id');
            $table->integer('jumlah');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar')->nullable();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('rack_id')->constrained('racks')->onDelete('cascade');
            $table->timestamps();
        });

        // Recommendations table (rekomendasi)
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id('id');
            $table->string('status');
            $table->float('confidence')->nullable();
            $table->text('alasan')->nullable();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->foreignId('rack_id')->constrained('racks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_rack_tables');
    }
};
