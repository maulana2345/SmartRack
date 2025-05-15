@extends('dashboard.main')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold mb-4">Data Barang</h5>

                    <div class="mb-3 d-flex gap-2">
                        <!-- Tombol Tambah Data -->
                        <a href="{{ route('barang.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </a>

                        <!-- Tombol Import Excel -->
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="importExcel" class="btn btn-warning mb-0">
                                <i class="fas fa-file-import me-1"></i> Import Excel
                            </label>
                            <input type="file" id="importExcel" name="file" accept=".xlsx,.xls" style="display:none"
                                onchange="this.form.submit()">
                        </form>
                        <!-- Tombol Export Excel -->
                        <a href="#" class="btn btn-success text-white">
                            <i class="fas fa-file-export me-1"></i> Export Excel
                        </a>
                    </div>

                    <!-- TABEL -->
                    <div class="table-responsive">
                        <form action="{{ route('barang.index') }}" method="GET" class="mb-3">
                            <div class="row g-2 align-items-end">

                                <!-- Search -->
                                <div class="col-md-4">
                                    <label class="form-label">Cari</label>
                                    <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                                        placeholder="Cari nama, jenis, kelompok...">
                                </div>

                                <!-- Kelompok -->
                                <div class="col-md-2">
                                    <label class="form-label">Kelompok</label>
                                    <select name="kelompok" class="form-select">
                                        <option value="">Semua</option>
                                        @foreach (['obat', 'pupuk', 'benih'] as $opt)
                                            <option value="{{ $opt }}" {{ request('kelompok') == $opt ? 'selected' : '' }}>
                                                {{ ucfirst($opt) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Satuan -->
                                <div class="col-md-2">
                                    <label class="form-label">Satuan</label>
                                    <select name="satuan" class="form-select">
                                        <option value="">Semua</option>
                                        @foreach (['btl', 'pcs', 'pack'] as $opt)
                                            <option value="{{ $opt }}" {{ request('satuan') == $opt ? 'selected' : '' }}>
                                                {{ strtoupper($opt) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Kadaluarsa -->
                                <div class="col-md-2">
                                    <label class="form-label">Status</label>
                                    <select name="kadaluarsa" class="form-select">
                                        <option value="">Semua</option>
                                        <option value="1" {{ request('kadaluarsa') == '1' ? 'selected' : '' }}>Kadaluarsa
                                        </option>
                                    </select>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-2">
                                    <button class="btn btn-outline-primary w-100" type="submit">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered text-nowrap align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kelompok</th>
                                    <th>Jenis</th>
                                    <th>Satuan</th>
                                    <th>QTY</th>
                                    <th>Dimensi</th>
                                    <th>Tgl Kadaluarsa</th>
                                    <th>Aksi</th> <!-- Kolom Aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kelompok }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->satuan }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->dimensi }}</td>
                                        <td>{{ $item->tgl_kadaluarsa }}</td>
                                        <td>
                                            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-sm btn-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" title="Hapus"
                                                    onclick="return confirm('Hapus data ini?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection