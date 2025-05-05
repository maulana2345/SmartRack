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
                        <table class="table table-bordered text-nowrap align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kelompok</th>
                                    <th>Jenis</th>
                                    <th>QTY</th>
                                    <th>Satuan</th>
                                    <th>Aksi</th> <!-- Kolom Aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->kelompok }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->satuan }}</td>
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

                </div>
            </div>
        </div>
    </div>

@endsection