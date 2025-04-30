@extends('dashboard.main')

@section('content')
<div class="row g-3 mb-4 mt-1">
  <!-- KIRI: 4 card kecil -->
  <div class="col-lg-8 d-flex flex-column justify-content-between">
    <!-- 2 card atas -->
    <div class="row g-3 mb-2">
      <!-- Total Barang -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-3 w-100" style="min-height: 150px;">
          <h6 class="text-muted mb-2">Total barang keseluruhan</h6>
          <h2 class="fw-bold mb-2">1.293.487</h2>
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Fast moving</span><span>827.126</span>
          </div>
          <div class="progress mb-3" style="height: 30px;">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 64%"></div>
          </div>
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Slow moving</span><span>466.361</span>
          </div>
          <div class="progress" style="height: 30px;">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 36%"></div>
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
              <h4 class="fw-bold text-primary">13.432</h4>
            </div>
            <div>
              <h6 class="mb-1 text-muted">Barang keluar</>
              <h4 class="fw-bold text-warning">2.162</h4>
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
            <span class="text-muted me-4">Kategori</span>
          </div>
          <div id="pie-fast" style="height: 140px;"></div>
        </div>
      </div>

      <!-- Slow Moving -->
      <div class="col-md-6 d-flex align-items-stretch">
        <div class="card p-3 w-100" style="min-height: 170px;">
          <div class="d-flex justify-content-between">
            <h6 class="text-muted">Slow Moving</h6>
            <span class="text-muted me-4">Kategori</span>
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
