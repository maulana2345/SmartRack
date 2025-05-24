@extends('dashboard.main')

@section('content')
    <style>
        /* Pastikan SEMUA SVG panah besar tidak tampil */
        svg:not(.apexcharts-svg):not(.chartjs-size-monitor) {
            display: none !important;
        }

        /* Seringkali icon panah dari font icon library pakai pseudo:before */
        .ti-arrow-left,
        .ti-arrow-right,
        .bi-chevron-left,
        .bi-chevron-right,
        .fa-chevron-left,
        .fa-chevron-right,
        .feather-chevron-left,
        .feather-chevron-right {
            display: none !important;
        }

        /* Jika panahnya berupa inline SVG <path> */
        .simplebar-content>svg,
        .simplebar-track>svg,
        .simplebar-track .simplebar-scrollbar>svg {
            display: none !important;
        }

        .pagination {
            gap: 0.25rem;
            /* jarak antar halaman */
        }

        .pagination li {
            margin: 0;
        }

        .pagination li a,
        .pagination li span {
            padding: 6px 10px;
            font-size: 0.85rem;
            border-radius: 4px;
        }

        /* Tambahkan padding agar info "Showing..." sejajar */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
    </style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold mb-4">Log Aktivitas Barang</h5>

                    <div class="table-responsive">
                        <form action="{{ route('log.index') }}" method="GET" class="mb-3">
                            <div class="row g-2 align-items-end">

                                <!-- Filter -->
                                <div class="col-md-4">
                                    <label class="form-label">Cari</label>
                                    <input type="text" name="search" class="form-control" placeholder="Cari nama barang..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control"
                                        value="{{ request('tgl_masuk') }}">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-outline-primary w-100"><i class="fas fa-filter"></i>
                                        Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tabel -->
                        <table class="table table-bordered text-nowrap align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Rak</th>
                                    <th>Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr>
                                        <td>{{ $log->kode_barang }}</td>
                                        <td>{{ $log->nama_barang }}</td>
                                        <td>{{ $log->jumlah }}</td>
                                        <td>{{ $log->tgl_masuk }}</td>
                                        <td>{{ $log->tgl_keluar ?? '-' }}</td>
                                        <td>{{ $log->kode_rak }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data aktivitas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3 px-2">
                        {{ $logs->onEachSide(1)->links('vendor.pagination.tailwind') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection