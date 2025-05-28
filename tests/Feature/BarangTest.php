<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Rak;
use Illuminate\Support\Facades\DB;

class BarangTest extends TestCase
{
     use RefreshDatabase;

    /** @test */
    public function admin_dapat_melihat_halaman_data_barang()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get('/barang');
        $response->assertStatus(200);
    }
}
