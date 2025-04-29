@extends('dashboard.main')

@section('content')
<div class="row g-3 mb-4">
  <!-- KIRI: 4 kotak kecil -->
  <div class="col-lg-8">
    <div class="row g-3">
      <!-- Total Barang -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-4 w-100">
          <h6 class="text-muted mb-4">Total barang keseluruhan</h6>
          <h2 class="fw-bold">1.293.487</h2>
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Fast moving</span><span>827.126</span>
          </div>
          <div class="progress mb-2" style="height: 16px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 64%"></div>
          </div>
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Slow moving</span><span>466.361</span>
          </div>
          <div class="progress" style="height: 16px;">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 36%"></div>
          </div>
        </div>
      </div>

      <!-- April -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-4 w-100">
          <h6 class="text-muted">April</h6>
          <div class="d-flex justify-content-between mb-3">
            <div>
              <p class="mb-1 text-muted">Barang masuk</p>
              <h4 class="fw-bold text-primary">13.432</h4>
            </div>
            <div>
              <p class="mb-1 text-muted">Barang keluar</p>
              <h4 class="fw-bold text-warning">2.162</h4>
            </div>
          </div>
          <div id="bar-april" style="height: 120px;"></div>
        </div>
      </div>

      <!-- Fast Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-4 w-100">
          <div class="d-flex justify-content-between">
            <h6 class="text-muted">Fast Moving</h6>
            <span class="text-muted">Kategori</span>
          </div>
          <div id="pie-fast" style="height: 200px;"></div>
        </div>
      </div>

      <!-- Slow Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-4 w-100">
          <div class="d-flex justify-content-between">
            <h6 class="text-muted">Slow Moving</h6>
            <span class="text-muted">Kategori</span>
          </div>
          <div id="pie-slow" style="height: 200px;"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- KANAN: Grafik Penjualan -->
  <div class="col-lg-4 d-flex align-items-stretch">
    <div class="card w-100 d-flex flex-column p-4">
      <h6 class="text-muted mb-3">Grafik Penjualan</h6>
      <div id="sales-chart" class="flex-grow-1" style="min-height: 420px;"></div>
      <div class="pt-3 d-flex justify-content-between small">
        <span><i class="ti ti-circle-filled text-primary me-1"></i> Penjualan</span>
        <span><i class="ti ti-circle-filled text-warning me-1"></i> Pembelian</span>
      </div>
    </div>
  </div>
</div>

<!-- TABEL -->
<div class="card p-4">
  <h6 class="fw-semibold mb-4">Aktivitas Terakhir</h6>
  <div class="table-responsive">
    <table class="table table-bordered text-nowrap align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Kategori</th>
          <th>Aktivitas</th>
          <th>Jumlah</th>
          <th>Satuan</th>
        </tr>
      </thead>
      <tbody>
        @for ($i = 0; $i < 7; $i++)
        <tr>
          <td>A01827381</td>
          <td>Aqua Gelas</td>
          <td>Minuman</td>
          <td>Masuk</td>
          <td>300</td>
          <td>Dus</td>
        </tr>
        @endfor
      </tbody>
    </table>
  </div>
</div>
@endsection
