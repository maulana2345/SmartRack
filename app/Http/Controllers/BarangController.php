<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('barang.index', compact('items'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required|in:btl,pcs,pack',
            'kelompok' => 'required|in:obat,pupuk,benih',
            'jenis' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'qty' => 'required|integer',
            'dimensi' => 'required|numeric',
        ]);

        Item::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('barang.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan' => 'required|in:btl,pcs,pack',
            'kelompok' => 'required|in:obat,pupuk,benih',
            'jenis' => 'required',
            'tgl_kadaluarsa' => 'required|date',
            'qty' => 'required|integer',
            'dimensi' => 'required|numeric',
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
}
