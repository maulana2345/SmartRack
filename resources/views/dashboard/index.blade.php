@extends('dashboard.main')

@section('content')
  <script>
    window.barangChart = {
    labels: @json($data['chart_labels']),
    masuk: @json($data['chart_masuk']),
    keluar: @json($data['chart_keluar'])
    };
  </script>

  <div class="row g-3">
    <!-- KIRI -->
    <div class="col-lg-8 d-flex flex-column justify-content-between">
    <!-- 2 card atas -->
    <div class="row g-3">
      <!-- Total Barang -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 150px;">
        <h6 class="text-muted mb-2">Total Data Barang</h6>
        <h2 class="fw-bold mb-2">{{ $data['total_barang'] }}</h2>
        <div class="d-flex justify-content-between small text-muted mb-1">
        <span>Barang Fast Moving</span><span>{{ $data['fast_moving'] }}</span>
        </div>
        <div class="progress mb-3" style="height: 30px;">
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $data['fast_percent'] }}%"></div>
        </div>
        <div class="d-flex justify-content-between small text-muted mb-1">
        <span>Barang Slow Moving</span><span>{{ $data['slow_moving'] }}</span>
        </div>
        <div class="progress" style="height: 30px;">
        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $data['slow_percent'] }}%"></div>
        </div>
      </div>
      </div>

      <!-- Barang Berdasarkan Kategori -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 150px;">
        <h6 class="text-muted mb-2">Total Kelompok Barang</h6>
        <div id="pie-kategori" style="height: 100px;"></div>
      </div>
      </div>
    </div>

    <!-- 2 card bawah -->
    <div class="row g-3">
      <!-- Fast Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 170px;">
        <div class="d-flex justify-content-between">
        <h6 class="text-muted mb-2">Kelompok Fast Moving</h6>
        </div>
        <div id="pie-fast" style="height: 140px;"></div>
      </div>
      </div>

      <!-- Slow Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 170px;">
        <div class="d-flex justify-content-between">
        <h6 class="text-muted">Kelompok Slow Moving</h6>
        </div>
        <div id="pie-slow" style="height: 140px;"></div>
      </div>
      </div>
    </div>
    </div>

    <!-- KANAN: Aktivitas Terbaru -->
    <div class="col-lg-4 d-flex flex-column">
    <div class="card w-100 d-flex flex-column p-3 h-100">
      <h6 class="text-muted mb-3">Aktivitas Terbaru</h6>
      <ul class="list-group list-group-flush flex-grow-1 overflow-auto">
      @forelse ($data['recent_activity'] as $row)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <div>
      <strong>{{ $row->nama_barang }}</strong><br>
      <small class="text-muted">{{ $row->tgl_masuk }}</small>
      </div>
      <span class="badge bg-primary">{{ $row->jumlah }} unit</span>
      </li>
    @empty
      <li class="list-group-item text-center text-muted">Tidak ada aktivitas terbaru</li>
    @endforelse
      </ul>
    </div>
    </div>

  </div>
  <!-- TABEL AKTIVITAS TERAKHIR -->
  <!-- <div class="card p-3" style="margin-top: -20px;">
    <h6 class="fw-semibold mb-3">Aktivitas Terakhir</h6>
    <div class="table-responsive">
    <table class="table table-bordered text-nowrap align-middle mb-0">
      <thead class="table-light">
      <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jumlah</th>
      <th>Tanggal Masuk</th>
      <th>Rak</th>
      </tr>
      </thead>
      <tbody>
      @forelse ($data['recent_activity'] as $row)
      <tr>
      <td>{{ $row->kode_barang }}</td>
      <td>{{ $row->nama_barang }}</td>
      <td>{{ $row->jumlah }}</td>
      <td>{{ $row->tgl_masuk }}</td>
      <td>{{ $row->kode_rak }}</td>
      </tr>
      @empty
      <tr>
      <td colspan="5" class="text-center">Tidak ada aktivitas terbaru</td>
      </tr>
      @endforelse
      </tbody>
    </table>
    </div>
    </div> -->
@endsection