<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('storage_details')
            ->join('items', 'storage_details.item_id', '=', 'items.id')
            ->join('racks', 'storage_details.rack_id', '=', 'racks.id')
            ->select(
                'storage_details.*',
                'items.kode_barang',
                'items.nama_barang',
                'racks.kode_rak'
            );

        // Filter: Nama Barang
        if ($request->filled('search')) {
            $query->where('items.nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter: Tanggal Masuk
        if ($request->filled('tgl_masuk')) {
            $query->whereDate('storage_details.tgl_masuk', $request->tgl_masuk);
        }

        $logs = $query->orderByDesc('storage_details.created_at')->paginate(10)->withQueryString();

        return view('aktivitas.index', compact('logs'));
    }
}
