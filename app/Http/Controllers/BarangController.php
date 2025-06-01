<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    // public function index()
    // {
    //     $items = Item::all();
    //     return view('barang.index', compact('items'));
    // }

    public function index(Request $request)
    {
        $query = Item::query();

        // Search global (nama_barang, jenis, kelompok)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis', 'like', '%' . $request->search . '%')
                    ->orWhere('kelompok', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kelompok
        if ($request->filled('kelompok')) {
            $query->where('kelompok', $request->kelompok);
        }

        // Filter berdasarkan satuan
        if ($request->filled('satuan')) {
            $query->where('satuan', $request->satuan);
        }

        // Filter berdasarkan tanggal kadaluarsa sebelum hari ini
        if ($request->has('kadaluarsa') && $request->kadaluarsa === '1') {
            $query->whereDate('tgl_kadaluarsa', '<', now());
        }

        $items = $query->paginate(10)->withQueryString();

        return view('barang.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();  // Ambil semua kategori
        return view('barang.create', compact('categories'));  // Kirim data kategori ke form
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang',
            'nama_barang' => 'required',
            'satuan' => 'required|in:btl,pcs,pack',
            'kelompok' => 'required|in:obat,pupuk,benih',
            'jenis' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'qty' => 'required|integer',
            'dimensi' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
        ]);

        // Menyimpan data barang
        Item::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();  // Ambil semua kategori
        return view('barang.edit', compact('item', 'categories'));  // Kirim data kategori ke form
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:items,kode_barang,' . $id,
            'nama_barang' => 'required',
            'satuan' => 'required|in:btl,pcs,pack',
            'kelompok' => 'required|in:obat,pupuk,benih',
            'jenis' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'qty' => 'required|integer',
            'dimensi' => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Validasi category_id
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus!');
    }

    // === Tambahan untuk Import CSV ===
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $header = array_map('strtolower', $data[0]);
        unset($data[0]);

        DB::beginTransaction();
        try {
            foreach ($data as $row) {
                $row = array_combine($header, $row);

                // Validasi category_id
                if (!Category::find($row['category_id'])) {
                    throw new \Exception('Kategori dengan ID ' . $row['category_id'] . ' tidak ditemukan!');
                }

                // Insert or update berdasarkan kode_barang
                Item::updateOrCreate(
                    ['kode_barang' => $row['kode_barang']],
                    [
                        'category_id' => $row['category_id'],
                        'nama_barang' => $row['nama_barang'],
                        'satuan' => $row['satuan'],
                        'kelompok' => $row['kelompok'],
                        'jenis' => $row['jenis'],
                        'tgl_kadaluarsa' => $row['tgl_kadaluarsa'],
                        'qty' => $row['qty'],
                        'dimensi' => $row['dimensi'],
                        'updated_at' => now(),
                    ]
                );
            }
            DB::commit();
            return redirect()->route('barang.index')->with('success', 'Import CSV berhasil!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}
