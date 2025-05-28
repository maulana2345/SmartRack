<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Rak;
use Illuminate\Support\Facades\DB;

class PenyimpananTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_dapat_melihat_halaman_penyimpanan()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/penyimpanan');
        $response->assertStatus(200);
        $response->assertSee('Denah Gudang');
    }

    /** @test */
    public function admin_dapat_rekomendasikan_lokasi()
    {
        // Persiapan data dummy: admin, item, rak
        $user = User::factory()->create(['role' => 'admin']);

        // Tambah category dummy (category_id=2)
        DB::table('categories')->insert([
            'id' => 2,
            'tipe_kategori' => 'slow',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambah item QJAGU03 (contoh barang)
        Item::create([
            'kode_barang' => 'QJAGU03',
            'nama_barang' => 'Jagung BISI',
            'dimensi' => 50,
            'satuan' => 'pack',
            'category_id' => 2,
            'kelompok' => 'benih',
            'jenis' => 'Benih',
            'tgl_kadaluarsa' => '2025-05-31',
            'qty' => 200,
        ]);

        // Tambah rak
        Rak::create([
            'kode_rak' => 'A01L01',
            'kapasitas_max' => 5000,
            'kapasitas_tersedia' => 5000,
            'jarak' => 199,
        ]);

        // Panggil endpoint rekomendasi
        $response = $this->actingAs($user)->post('/rekomendasi-lokasi', [
            'item_name' => 'QJAGU03',
            'quantity' => 10,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['recommended_rak']);
    }
    /** @test */
    public function admin_dapat_menempatkan_barang_manual()
    {
        $user = User::factory()->create(['role' => 'admin']);
        // Tambah category dummy (category_id=2)
        DB::table('categories')->insert([
            'id' => 2,
            'tipe_kategori' => 'slow',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Tambah item QJAGU03 (contoh barang)
        Item::create([
            'kode_barang' => 'QJAGU03',
            'nama_barang' => 'Jagung BISI',
            'dimensi' => 50,
            'satuan' => 'pack',
            'category_id' => 2,
            'kelompok' => 'benih',
            'jenis' => 'Benih',
            'tgl_kadaluarsa' => '2025-05-31',
            'qty' => 200,
        ]);
        Rak::create([
            'kode_rak' => 'A01L01',
            'kapasitas_max' => 5000,
            'kapasitas_tersedia' => 5000,
            'jarak' => 199,
        ]);

        $response = $this->actingAs($user)->post('/penyimpanan/manual-placement', [
            'item_name' => 'QJAGU03',
            'quantity' => 200,
            'rak' => 'A01L01',
            'level' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'kapasitas_tersedia', 'rak']);
    }

    /** @test */
public function admin_dapat_mengeluarkan_barang()
{
    $user = User::factory()->create(['role' => 'admin']);

    // Tambah category dummy
    DB::table('categories')->insert([
        'id' => 2,
        'tipe_kategori' => 'slow',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Tambah item dummy
    $item = Item::create([
        'kode_barang' => 'QJAGU03',
        'nama_barang' => 'Jagung BISI',
        'dimensi' => 50,
        'satuan' => 'pack',
        'category_id' => 2,
        'kelompok' => 'benih',
        'jenis' => 'Benih',
        'tgl_kadaluarsa' => '2025-05-31',
        'qty' => 200,
    ]);

    // Tambah rak
    $rak = Rak::create([
        'kode_rak' => 'A01L01',
        'kapasitas_max' => 5000,
        'kapasitas_tersedia' => 5000,
        'jarak' => 199,
    ]);

    // Tambah data awal: item sudah ada di rak
    DB::table('storage_details')->insert([
        'item_id' => $item->id,
        'rack_id' => $rak->id,
        'jumlah' => 20,
        'tgl_masuk' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Panggil endpoint untuk mengeluarkan barang
    $response = $this->actingAs($user)->post('/penyimpanan/hapus-barang', [
        'item_name' => 'QJAGU03',
        'quantity' => 10,
        'rak' => 'A01L01',
        'level' => 1,
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure(['success', 'kapasitas_tersedia', 'rak']);
}


}
