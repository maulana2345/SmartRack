<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PenyimpananController extends Controller
{
    public function index()
    {
        $rakData = Rak::all();
        $kapasitasRak = $rakData->mapWithKeys(fn($rak) => [$rak->kode_rak => $rak->kapasitas_tersedia]);
        return view('penyimpanan.index', compact('rakData', 'kapasitasRak'));
    }

    public function rekomendasiLokasi(Request $request)
    {
        try {
            $itemName = $request->input('item_name');
            $quantity = (int) $request->input('quantity');

            $item = Item::with('category')
                ->where('kode_barang', $itemName)
                ->orWhere('nama_barang', $itemName)
                ->first();

            if (!$item) {
                return response()->json([
                    'error' => 'Barang tidak ditemukan dalam database.'
                ], 404);
            }

            $kategori = strtolower($item->category->tipe_kategori ?? 'fast');
            $rakData = Rak::select('kode_rak', 'kapasitas_tersedia', 'kapasitas_max', 'jarak')->get();

            \Log::info("KATEGORI ITEM:", [
                'kode_barang' => $item->kode_barang,
                'kategori' => $item->category->nama ?? 'null'
            ]);

            $response = Http::post('http://127.0.0.1:5000/api/rekomendasi', [
                'kode_barang' => $item->kode_barang,
                'kategori' => $kategori,
                'stock' => $quantity,
                'rak_list' => $rakData->toArray(),
            ]);

            if ($response->failed()) {
                return response()->json([
                    'error' => 'Gagal mendapatkan rekomendasi dari service Python.'
                ], 500);
            }

            return response()->json([
                'recommended_rak' => $response['recommended_rak']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi error di server.',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function storePlacement(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'rak' => 'required|string',
            'level' => 'required|integer|in:1,2',
        ]);

        $itemName = $request->input('item_name');
        $quantity = $request->input('quantity');
        $kodeRakLengkap = $request->input('rak');
        $level = $request->input('level');

        $item = Item::where('kode_barang', $itemName)
            ->orWhere('nama_barang', $itemName)
            ->first();

        if (!$item) {
            return response()->json(['error' => 'Barang tidak ditemukan.'], 404);
        }

        $rack = Rak::where('kode_rak', $kodeRakLengkap)->first();

        if (!$rack) {
            return response()->json(['error' => 'Rak tidak ditemukan.'], 404);
        }

        $existing = DB::table('storage_details')
            ->where('rack_id', $rack->id)
            ->where('item_id', $item->id)
            ->first();

        if ($existing) {
            DB::table('storage_details')
                ->where('id', $existing->id)
                ->update(['jumlah' => $existing->jumlah + $quantity]);
        } else {
            DB::table('storage_details')->insert([
                'item_id' => $item->id,
                'rack_id' => $rack->id,
                'jumlah' => $quantity,
                'tgl_masuk' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $rack->kapasitas_tersedia = max(0, $rack->kapasitas_tersedia - $quantity);
        $rack->save();

        return response()->json([
            'success' => "Barang berhasil ditempatkan di Rak {$kodeRakLengkap}, Level {$level}",
            'kapasitas_tersedia' => $rack->kapasitas_tersedia,
            'rak' => $kodeRakLengkap,
        ]);
    }

    public function removePlacement(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'rak' => 'required|string',
            'level' => 'required|integer|in:1,2',
        ]);

        $itemName = $request->input('item_name');
        $quantity = $request->input('quantity');
        $kodeRakLengkap = $request->input('rak');
        $level = $request->input('level');

        $item = Item::where('kode_barang', $itemName)
            ->orWhere('nama_barang', $itemName)
            ->first();

        if (!$item) {
            return response()->json(['error' => 'Barang tidak ditemukan.'], 404);
        }

        $rack = Rak::where('kode_rak', $kodeRakLengkap)->first();

        if (!$rack) {
            return response()->json(['error' => 'Rak tidak ditemukan.'], 404);
        }

        $storage = DB::table('storage_details')
            ->where('rack_id', $rack->id)
            ->where('item_id', $item->id)
            ->first();

        if (!$storage) {
            return response()->json(['error' => 'Barang tidak ditemukan di lokasi tersebut.'], 404);
        }

        if ($storage->jumlah < $quantity) {
            return response()->json(['error' => 'Jumlah pengeluaran melebihi stok.'], 400);
        }

        $newQty = $storage->jumlah - $quantity;

        if ($newQty > 0) {
            DB::table('storage_details')
                ->where('id', $storage->id)
                ->update(['jumlah' => $newQty]);
        } else {
            DB::table('storage_details')->where('id', $storage->id)->delete();
        }

        $rack->kapasitas_tersedia += $quantity;
        $rack->save();

        return response()->json([
            'success' => "Barang berhasil dikeluarkan dari Rak {$kodeRakLengkap}, Level {$level}",
            'kapasitas_tersedia' => $rack->kapasitas_tersedia,
            'rak' => $kodeRakLengkap,
        ]);
    }
}
