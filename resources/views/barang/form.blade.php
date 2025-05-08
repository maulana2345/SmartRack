<div class="mb-3">
    <label>Kode Barang</label>
    <input type="text" name="kode_barang" class="form-control"
        value="{{ old('kode_barang', $item->kode_barang ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', $item->nama_barang ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Satuan</label>
    <select name="satuan" class="form-select" required>
        @foreach(['btl', 'pcs', 'pack'] as $val)
            <option value="{{ $val }}" @selected(old('satuan', $item->satuan ?? '') == $val)>{{ $val }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Kelompok</label>
    <select name="kelompok" class="form-select" required>
        @foreach(['obat', 'pupuk', 'benih'] as $val)
            <option value="{{ $val }}" @selected(old('kelompok', $item->kelompok ?? '') == $val)>{{ $val }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jenis</label>
    <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $item->jenis ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Tanggal Kadaluarsa</label>
    <input type="date" name="tgl_kadaluarsa" class="form-control" value="{{ old('tgl_kadaluarsa', $item->tgl_kadaluarsa ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Qty</label>
    <input type="number" name="qty" class="form-control" value="{{ old('qty', $item->qty ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Dimensi</label>
    <input type="number" step="0.01" name="dimensi" class="form-control" value="{{ old('dimensi', $item->dimensi ?? '') }}" required>
</div>
