@extends('dashboard.main')

@section('content')
    <style>
        .denah-row {
            gap: 12px;
        }

        .rak-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .grid-rak {
            display: grid;
            grid-template-columns: repeat(2, 40px);
            grid-template-rows: repeat(5, 40px);
            gap: 10px;
            padding: 12px;
            background: #f4f4f4;
            border-radius: 12px;
        }

        .grid-box {
            width: 40px;
            height: 40px;
            background-color: #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .grid-box:hover {
            transform: scale(1.1);
            background-color: #bcd3f7;
        }

        .grid-box.active {
            outline: 2px solid #ff7043;
        }

        .legend-color {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 6px;
            vertical-align: middle;
        }

        .kosong {
            background-color: #e0e0e0 !important;
        }

        .terpakai {
            background-color: #ffcc00 !important;
        }

        .penuh {
            background-color: #073B4C !important;
        }

        .rak-card {
            background-color: #d4f8e8;
            border-radius: 10px;
            padding: 12px 16px;
        }

        .divider {
            border-top: 1px solid #e0e0e0;
            margin: 1.5rem 0;
        }

        #rakPopover::before {
            content: "";
            position: absolute;
            top: 12px;
            left: -6px;
            width: 0;
            height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-right: 6px solid white;
        }
    </style>
    <script>
        let kapasitasRak = @json($kapasitasRak);
    </script>

    <div id="rakPopover" class="position-absolute shadow p-3 bg-white rounded border"
        style="display: none; min-width: 220px; z-index: 1000;">
    </div>

    <div class="d-flex gap-4 flex-nowrap">
        <!-- Denah Gudang -->
        <div class="card p-4 flex-grow-1" style="min-width: 800px;">
            <h5 class="fw-bold mb-3">Denah Gudang</h5>

            <!-- Legend -->
            <div class="d-flex gap-4 mb-4">
                <div><span class="legend-color kosong"></span> Kosong </div>
                <div><span class="legend-color terpakai"></span> Terpakai </div>
                <div><span class="legend-color penuh"></span> Penuh</div>
            </div>

            <!-- Denah Rak: Baris 1 -->
            <div class="denah-row d-flex justify-content-around mb-4">
                @foreach (range('A', 'E') as $row)
                    <div class="rak-item text-center">
                        <div class="grid-rak">
                            @for ($i = 1; $i <= 20; $i++)
                                @php
                                    $level = $i % 2 == 1 ? 'L02' : 'L01';
                                    $no = str_pad(ceil($i / 2), 2, '0', STR_PAD_LEFT);
                                    $kodeRak = "{$row}{$no}{$level}"; // contoh A01L01, A01L02, A02L01, dll
                                @endphp
                                <div class="grid-box status-kosong" data-kode="{{ $kodeRak }}" onclick="showDetail(this)">
                                </div>
                            @endfor
                        </div>
                        <div class="mt-2 fw-bold text-muted">Rak {{ $row }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Denah Rak: Baris 2 -->
            <div class="denah-row d-flex justify-content-around">
                @foreach (range('F', 'J') as $row)
                    <div class="rak-item text-center">
                        <div class="grid-rak">
                            @for ($i = 1; $i <= 20; $i++)
                                @php
                                    $level = $i % 2 == 1 ? 'L02' : 'L01';
                                    $no = str_pad(ceil($i / 2), 2, '0', STR_PAD_LEFT);
                                    $kodeRak = "{$row}{$no}{$level}"; // contoh: F01L01, F01L02, F02L01, dst.
                                @endphp
                                <div class="grid-box status-kosong" data-kode="{{ $kodeRak }}" onclick="showDetail(this)">
                                </div>
                            @endfor
                        </div>
                        <div class="mt-2 fw-bold text-muted">Rak {{ $row }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Pintu -->
            <div class="d-flex justify-content-between mt-4">
                <small class="text-muted">Pintu Masuk</small>
                <small class="text-muted">Pintu Keluar</small>
            </div>
        </div>

        <!-- Detail Rak + Rekomendasi AI -->
        <div class="card p-4" style="min-width: 320px;">
            <h5 class="fw-bold mb-3 text-primary">Rekomendasi Penempatan (AI)</h5>

            <!-- Rekomendasi AI -->
            <form id="rekomendasiForm" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="item_name" name="item_name" class="form-control"
                        placeholder="Contoh: QJAGU03/Jagung BISI" required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Contoh: 100"
                            required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Rekomendasikan Lokasi</button>
            </form>

            <!-- Output rekomendasi -->
            <div id="rekomendasiResult" class="rak-card bg-light border-start border-success border-4 mb-3 d-none">
                <p class="mb-1"><strong id="lokasiRak"></strong></p>
                <p class="text-muted mb-0">Rekomendasi penempatan terbaik berdasarkan kapasitas dan aksesibilitas.</p>
            </div>

            <!-- Tombol simpan dari AI -->
            <button id="taruhBarangBtn" class="btn btn-success w-100 d-none mb-2">
                Taruh Barang di Lokasi Ini
            </button>

            <div class="divider"></div>

            <!-- Penempatan Manual -->
            <h5 class="fw-bold mb-3 text-warning">Penempatan Manual</h5>
            <form id="manualForm" class="mb-3" method="POST" action="/penyimpanan/manual-placement">
                @csrf
                <div class="mb-3">
                    <label for="manual_item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="manual_item_name" class="form-control" placeholder="Contoh: QJAGU03/Jagung BISI"
                        required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="manual_quantity" name="quantity" class="form-control" placeholder="Contoh: 100"
                            required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Rak</label>
                        <select id="manual_rak" class="form-select" required>
                            @foreach (range('A', 'J') as $r)
                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $no = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $kodeRak = "{$r}{$no}";
                                    @endphp
                                    <option value="{{ $kodeRak }}">Rak {{ $kodeRak }}</option>
                                @endfor
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Level</label>
                        <select id="manual_level" class="form-select" required>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning w-100">Simpan ke Lokasi</button>
            </form>

            <div class="divider"></div>

            <!-- Pengeluaran Barang -->
            <h5 class="fw-bold mb-3 text-danger">Pengeluaran Barang</h5>
            <form id="hapusBarangForm" class="mb-3" method="POST" action="/penyimpanan/hapus-barang">
                @csrf
                <div class="mb-3">
                    <label for="manual_item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="hapus_item_name" class="form-control" placeholder="Contoh: QJAGU03/Jagung BISI"
                        required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="hapus_quantity" name="quantity" class="form-control" placeholder="Contoh: 100"
                            required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Rak</label>
                        <select id="hapus_rak" class="form-select">
                            @foreach (range('A', 'J') as $rak)
                                @for ($i = 1; $i <= 10; $i++)
                                    @php
                                        $no = str_pad($i, 2, '0', STR_PAD_LEFT);
                                        $kodeRak = "{$rak}{$no}";
                                    @endphp
                                    <option value="{{ $kodeRak }}">Rak {{ $kodeRak }}</option>
                                @endfor
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Level</label>
                        <select id="hapus_level" class="form-select">
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">Keluarkan Barang</button>
            </form>
        </div>

        <!-- Modal Detail Rak -->
        <div class="modal fade" id="detailRakModal" tabindex="-1" aria-labelledby="detailRakModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailRakModalLabel">Detail Rak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="modalRakContent">
                        <p>Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Skrip JS untuk fitur penyimpanan dan pewarnaan rak
        function showDetail(el) {
            const kodeRak = el.getAttribute('data-kode') || (el.getAttribute('data-rak') + (el.getAttribute('data-level') === '1' ? 'L01' : 'L02'));
            document.querySelectorAll('.grid-box').forEach(box => box.classList.remove('active'));
            el.classList.add('active');

            // Sembunyikan popover
            document.getElementById('rakPopover').style.display = 'none';

            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('detailRakModal'));
            modal.show();

            // Kosongkan dulu konten
            const modalContent = document.getElementById('modalRakContent');
            modalContent.innerHTML = '<p>Memuat data...</p>';

            // Fetch data detail rak
            fetch(`/penyimpanan/detail-rak/${kodeRak}`)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal mengambil data.');
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        modalContent.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                        return;
                    }

                    if (data.storage.length === 0) {
                        modalContent.innerHTML = `<p>Rak <strong>${kodeRak}</strong> kosong.</p>`;
                    } else {
                        let html = `<p><strong>Rak ${kodeRak}</strong></p>`;
                        html += `<ul class="list-group">`;
                        data.storage.forEach(item => {
                            html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                    ${item.nama_barang} (${item.kode_barang})
                    <span class="badge bg-primary rounded-pill">${item.jumlah} ${item.satuan}</span>
                  </li>`;
                        });
                        html += `</ul>`;
                        modalContent.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error(error);
                    modalContent.innerHTML = `<div class="alert alert-danger">Terjadi error saat mengambil data.</div>`;
                });
        }

        document.addEventListener('click', function (e) {
            const popover = document.getElementById('rakPopover');
            if (!popover.contains(e.target) && !e.target.classList.contains('grid-box')) {
                popover.style.display = 'none';
                document.querySelectorAll('.grid-box').forEach(box => box.classList.remove('active'));
            }
        });

        function updateRakColors() {
            document.querySelectorAll('.grid-box').forEach(box => {
                const kodeRak = box.getAttribute('data-kode');
                box.classList.remove('kosong', 'terpakai', 'penuh');

                if (kodeRak && kapasitasRak[kodeRak] !== undefined) {
                    const kapasitas = kapasitasRak[kodeRak];
                    if (kapasitas <= 0) {
                        box.classList.add('penuh');
                    } else if (kapasitas < 4999) {
                        box.classList.add('terpakai');
                    } else {
                        box.classList.add('kosong');
                    }
                } else {
                    box.classList.add('kosong');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateRakColors();

            document.getElementById('rekomendasiForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const itemName = document.getElementById('item_name').value.trim();
                const quantity = document.getElementById('quantity').value.trim();

                if (!itemName || !quantity || isNaN(quantity) || Number(quantity) <= 0) {
                    alert('Mohon isi data barang dan quantity dengan benar.');
                    return;
                }

                fetch('/rekomendasi-lokasi', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ item_name: itemName, quantity })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) return alert('Error: ' + data.error);

                        const rakStr = data.recommended_rak;
                        if (!rakStr || rakStr.length < 5) return alert('Rekomendasi tidak valid.');

                        const rakHuruf = rakStr.charAt(0);
                        const no = rakStr.slice(1, 3);
                        const level = parseInt(rakStr.slice(4), 10);
                        if (isNaN(level)) return alert('Level tidak valid.');

                        document.getElementById('lokasiRak').innerText = `Rak ${rakHuruf}${no}, Level ${level}`;
                        document.getElementById('rekomendasiResult').classList.remove('d-none');

                        const btn = document.getElementById('taruhBarangBtn');
                        btn.classList.remove('d-none');
                        btn.setAttribute('data-rak', `${rakHuruf}${no}`);
                        btn.setAttribute('data-level', level);
                        btn.setAttribute('data-item-name', itemName);
                        btn.setAttribute('data-quantity', quantity);
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Gagal mendapatkan rekomendasi.');
                    });
            });

            document.getElementById('taruhBarangBtn').addEventListener('click', function () {
                const rak = this.getAttribute('data-rak');
                const level = this.getAttribute('data-level');
                const rakKode = rak + (level === '1' ? 'L01' : 'L02');

                fetch('/penyimpanan/manual-placement', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        item_name: this.getAttribute('data-item-name'),
                        quantity: this.getAttribute('data-quantity'),
                        rak: rakKode,
                        level: parseInt(level)
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) return alert('Error: ' + data.error);

                        kapasitasRak[rakKode] = data.kapasitas_tersedia;
                        updateRakColors();
                        alert(data.success);
                        this.classList.add('d-none');
                        document.getElementById('rekomendasiResult').classList.add('d-none');
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Gagal menyimpan data.');
                    });
            });

            // === Handler Penempatan Manual ===
            document.getElementById('manualForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const itemName = document.getElementById('manual_item_name').value.trim();
                const quantity = document.getElementById('manual_quantity').value.trim();  // ini field 'quantity'
                const rak = document.getElementById('manual_rak').value;
                const level = document.getElementById('manual_level').value;

                if (!itemName || !quantity || isNaN(quantity) || Number(quantity) <= 0) {
                    alert('Mohon isi data penempatan manual dengan benar.');
                    return;
                }
                const rakKode = rak + (level === '1' ? 'L01' : 'L02');
                fetch('/penyimpanan/manual-placement', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        item_name: itemName,
                        quantity: quantity,
                        rak: rakKode,
                        level: parseInt(level)
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) return alert('Error: ' + data.error);
                        alert(data.success);
                        kapasitasRak[rakKode] = data.kapasitas_tersedia;
                        updateRakColors();
                        this.reset();
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi error saat menyimpan penempatan manual.');
                    });
            });

            // === Handler Pengeluaran Barang ===
            document.getElementById('hapusBarangForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const itemName = document.getElementById('hapus_item_name').value.trim();
                const quantity = document.getElementById('hapus_quantity').value.trim();
                const rak = document.getElementById('hapus_rak').value;
                const level = document.getElementById('hapus_level').value;

                if (!itemName || !quantity || isNaN(quantity) || Number(quantity) <= 0) {
                    alert('Mohon isi data pengeluaran barang dengan benar.');
                    return;
                }
                const rakKode = rak + (level === '1' ? 'L01' : 'L02');
                fetch('/penyimpanan/hapus-barang', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        item_name: itemName,
                        quantity: quantity,
                        rak: rakKode,
                        level: parseInt(level)
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) return alert('Error: ' + data.error);
                        alert(data.success);
                        kapasitasRak[rakKode] = data.kapasitas_tersedia;
                        updateRakColors();
                        this.reset();
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Terjadi error saat menghapus barang.');
                    });
            });
        });
    </script>

@endsection