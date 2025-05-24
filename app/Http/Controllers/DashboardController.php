<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class DashboardController extends Controller
{
    public function index()
    {
        $totalQty = Item::sum('qty');
        $fastQty = Item::where('category_id', '1')->sum('qty');
        $slowQty = Item::where('category_id', '2')->sum('qty');


        $barangMasuk = DB::table('storage_details')->sum('jumlah');
        $barangKeluar = DB::table('storage_details')->whereNotNull('tgl_keluar')->sum('jumlah');

        $recentActivity = DB::table('storage_details')
            ->join('items', 'storage_details.item_id', '=', 'items.id')
            ->join('racks', 'storage_details.rack_id', '=', 'racks.id')
            ->orderByDesc('storage_details.created_at')
            ->limit(7)
            ->select(
                'items.kode_barang',
                'items.nama_barang',
                'storage_details.jumlah',
                'storage_details.tgl_masuk',
                'storage_details.tgl_keluar',
                'racks.kode_rak'
            )
            ->get();

        $perBulan = DB::table('storage_details')
            ->selectRaw("MONTH(tgl_masuk) as bulan, 
                SUM(jumlah) as masuk,
                SUM(CASE WHEN tgl_keluar IS NOT NULL THEN jumlah ELSE 0 END) as keluar")
            ->groupByRaw("MONTH(tgl_masuk)")
            ->orderByRaw("MONTH(tgl_masuk)")
            ->get();

        $labels = [];
        $masuk = [];
        $keluar = [];

        foreach ($perBulan as $row) {
            $labels[] = DateTime::createFromFormat('!m', $row->bulan)->format('M');
            $masuk[] = $row->masuk;
            $keluar[] = $row->keluar;
        }

        $data = [
            'total_barang' => number_format($totalQty),
            'fast_moving' => number_format($fastQty),
            'slow_moving' => number_format($slowQty),
            'fast_percent' => $totalQty ? round($fastQty / $totalQty * 100, 1) : 0,
            'slow_percent' => $totalQty ? round($slowQty / $totalQty * 100, 1) : 0,
            'barang_masuk' => number_format($barangMasuk),
            'barang_keluar' => number_format($barangKeluar),
            'recent_activity' => $recentActivity,
            'chart_labels' => $labels,
            'chart_masuk' => $masuk,
            'chart_keluar' => $keluar,
        ];

        return view('dashboard.index', compact('data'));
    }
}
