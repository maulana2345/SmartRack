@extends('dashboard.main')

@section('content')
  <script>
    window.barangChart = {
    labels: @json($data['chart_labels']),
    masuk: @json($data['chart_masuk']),
    keluar: @json($data['chart_keluar'])
    };
  </script>

  <div class="row g-3 mb-4 mt-1">
    <!-- KIRI: 4 card kecil -->
    <div class="col-lg-8 d-flex flex-column justify-content-between">
    <!-- 2 card atas -->
    <div class="row g-3 mb-2">
      <!-- Total Barang -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 150px;">
        <h6 class="text-muted mb-2">Total barang keseluruhan</h6>
        <h2 class="fw-bold mb-2">{{ $data['total_barang'] }}</h2>
        <div class="d-flex justify-content-between small text-muted mb-1">
        <span>Fast moving</span><span>{{ $data['fast_moving'] }}</span>
        </div>
        <div class="progress mb-3" style="height: 30px;">
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $data['fast_percent'] }}%"></div>
        </div>
        <div class="d-flex justify-content-between small text-muted mb-1">
        <span>Slow moving</span><span>{{ $data['slow_moving'] }}</span>
        </div>
        <div class="progress" style="height: 30px;">
        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $data['slow_percent'] }}%"></div>
        </div>
      </div>
      </div>

      <!-- April -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 150px;">
        <!-- <h6 class="text-muted">April</h6> -->
        <div class="d-flex justify-content-between mb-0">
        <div>
          <h6 class="mb-1 text-muted">Barang masuk</>
          <h4 class="fw-bold text-primary">{{ $data['barang_masuk'] }}</h4>
        </div>
        <div>
          <h6 class="mb-1 text-muted">Barang keluar</>
          <h4 class="fw-bold text-warning">{{ $data['barang_keluar'] }}</h4>
        </div>
        </div>
        <div id="bar-april" style="height: 100px; margin-top: -10px;"></div>
      </div>
      </div>
    </div>

    <!-- 2 card bawah -->
    <div class="row g-3">
      <!-- Fast Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 170px;">
        <div class="d-flex justify-content-between">
        <h6 class="text-muted mb-2">Fast Moving</h6>
        <!-- <span class="text-muted me-4">Kategori</span> -->
        </div>
        <div id="pie-fast" style="height: 140px;"></div>
      </div>
      </div>

      <!-- Slow Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
      <div class="card p-3 w-100" style="min-height: 170px;">
        <div class="d-flex justify-content-between">
        <h6 class="text-muted">Slow Moving</h6>
        <!-- <span class="text-muted me-4">Kategori</span> -->
        </div>
        <div id="pie-slow" style="height: 140px;"></div>
      </div>
      </div>
    </div>
    </div>

    <!-- KANAN: Grafik Penjualan -->
    <div class="col-lg-4 d-flex align-items-stretch">
    <div class="card w-100 d-flex flex-column p-3" style="min-height: 370px;">
      <h6 class="text-muted mb-2">Grafik Penjualan</h6>
      <div id="sales-chart" class="flex-grow-1" style="height: 100%;"></div>
      <div class="pt-2 d-flex justify-content-between small">
      <span><i class="ti ti-circle-filled text-primary me-1"></i> Penjualan</span>
      <span><i class="ti ti-circle-filled text-warning me-1"></i> Pembelian</span>
      </div>
    </div>
    </div>
  </div>

  <!-- TABEL -->
  <div class="card p-3" style="margin-top: -20px  ">
    <h6 class="fw-semibold mb-3">Aktivitas Terakhir</h6>
    <div class="table-responsive">
    <table class="table table-bordered text-nowrap align-middle mb-0">
      <thead class="table-light">
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
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
      <td>{{ $row->tgl_keluar ?? '-' }}</td>
      <td>{{ $row->kode_rak }}</td>
      </tr>
    @empty
      <tr>
      <td colspan="6" class="text-center">Tidak ada aktivitas terbaru</td>
      </tr>
    @endforelse
      </tbody>

    </table>
    </div>
  </div>
@endsection