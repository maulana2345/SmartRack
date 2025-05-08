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
            background-color: #e0e0e0;
        }

        .terpakai {
            background-color: #ffcc00;
        }

        .hampir-penuh {
            background-color: #ff9966;
        }

        .penuh {
            background-color: #073B4C;
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
                <!-- <div><span class="legend-color hampir-penuh"></span> Hampir Penuh</div> -->
                <div><span class="legend-color penuh"></span> Penuh</div>
            </div>

            <!-- Denah Rak: Baris 1 -->
            <div class="denah-row d-flex justify-content-around mb-4">
                @foreach (range('A', 'E') as $rak)
                    <div class="rak-item text-center">
                        <div class="grid-rak">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="grid-box status-kosong" data-rak="Rak {{ $rak }}" data-level="Level {{ ceil($i / 2) }}"
                                    onclick="showDetail(this)">
                                </div>
                            @endfor
                        </div>
                        <div class="mt-2 fw-bold text-muted">Rak {{ $rak }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Denah Rak: Baris 2 -->
            <div class="denah-row d-flex justify-content-around">
                @foreach (range('F', 'J') as $rak)
                    <div class="rak-item text-center">
                        <div class="grid-rak">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="grid-box status-kosong" data-rak="Rak {{ $rak }}" data-level="Level {{ ceil($i / 2) }}"
                                    onclick="showDetail(this)">
                                </div>
                            @endfor
                        </div>
                        <div class="mt-2 fw-bold text-muted">Rak {{ $rak }}</div>
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
                <div class="mb-3">
                    <label for="item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="item_name" name="item_name" class="form-control"
                        placeholder="Contoh: QJAGU03/Jagung BISI" required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="item_name" name="item_name" class="form-control"
                            placeholder="Contoh: 100" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Rekomendasikan Lokasi</button>
            </form>

            <!-- Output rekomendasi -->
            <div id="rekomendasiResult" class="rak-card bg-light border-start border-success border-4 mb-3 d-none">
                <p class="mb-1"><strong id="lokasiRak">Rak C, Level 2</strong></p>
                <p class="text-muted mb-0">Rekomendasi penempatan terbaik berdasarkan kapasitas dan aksesibilitas.</p>
            </div>

            <!-- Tombol simpan dari AI -->
            <button id="taruhBarangBtn" class="btn btn-success w-100 d-none mb-2">
                Taruh Barang di Lokasi Ini
            </button>

            <div class="divider"></div>

            <!-- Penempatan Manual -->
            <h5 class="fw-bold mb-3 text-warning">Penempatan Manual</h5>
            <form id="manualForm" class="mb-3">
                <div class="mb-3">
                    <label for="manual_item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="manual_item_name" class="form-control" placeholder="Contoh: QJAGU03/Jagung BISI"
                        required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="item_name" name="item_name" class="form-control"
                            placeholder="Contoh: 100" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Rak</label>
                        <select id="manual_rak" class="form-select" required>
                            @foreach (range('A', 'J') as $r)
                                <option value="{{ $r }}">Rak {{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Level</label>
                        <select id="manual_level" class="form-select" required>
                            @for ($l = 1; $l <= 5; $l++)
                                <option value="{{ $l }}">Level {{ $l }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning w-100">Simpan ke Lokasi</button>
            </form>

            <div class="divider"></div>

            <!-- Pengeluaran Barang -->
            <h5 class="fw-bold mb-3 text-danger">Pengeluaran Barang</h5>
            <form id="hapusBarangForm" class="mb-3">
                <div class="mb-3">
                    <label for="manual_item_name" class="form-label">Kode/Nama Barang</label>
                    <input type="text" id="hapus_item_name" class="form-control" placeholder="Contoh: QJAGU03/Jagung BISI"
                        required>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="item_name" name="item_name" class="form-control"
                            placeholder="Contoh: 100" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <label class="form-label">Rak</label>
                        <select id="hapus_rak" class="form-select">
                            @foreach (range('A', 'J') as $rak)
                                <option value="{{ $rak }}">Rak {{ $rak }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Level</label>
                        <select id="hapus_level" class="form-select">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">Level {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">Keluarkan Barang</button>
            </form>

        </div>

        <!-- Modal Detail Rak -->
        <div class="modal fade" id="detailRakModal" tabindex="-1" aria-labelledby="detailRakModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailRakModalLabel">Detail Rak</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body" id="modalRakContent">
                        <!-- Konten dinamis diisi lewat JavaScript -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function showDetail(el) {
            const rak = el.getAttribute('data-rak');
            const level = el.getAttribute('data-level');
            const popover = document.getElementById('rakPopover');

            document.querySelectorAll('.grid-box').forEach(box => box.classList.remove('active'));
            el.classList.add('active');

            popover.innerHTML = `
                                                <p class="fw-bold text-success mb-1">${rak}, ${level}</p>
                                                <small>QJAGU03 - Jagung BISI</small><br>
                                                <small>AAFON01 - Afonil 50 SC 40 X 250 ml</small><br>
                                                <small>AARIZ01 - Arizona 55 EC 80 ml</small>
                                                <div class="text-end mt-2"><small>Aktivitas terakhir: 04/05/2025</small></div>
                                            `;

            const rect = el.getBoundingClientRect();
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollLeft = window.scrollX || document.documentElement.scrollLeft;

            const popoverWidth = 240;
            const offsetX = -240; // lebih dekat horizontal
            const offsetY = -5; // lebih sejajar vertikal

            let left = rect.right + scrollLeft + offsetX;
            let top = rect.top + scrollTop + offsetY;

            if (rect.right + popoverWidth > window.innerWidth) {
                left = rect.left + scrollLeft - popoverWidth - offsetX;
            }

            popover.style.display = 'block';
            popover.style.top = `${top}px`;
            popover.style.left = `${left}px`;
        }

        document.addEventListener('click', function (e) {
            const popover = document.getElementById('rakPopover');
            if (!popover.contains(e.target) && !e.target.classList.contains('grid-box')) {
                popover.style.display = 'none';
                document.querySelectorAll('.grid-box').forEach(box => box.classList.remove('active'));
            }
        });

        // Simulasi rekomendasi lokasi
        document.getElementById('rekomendasiForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const itemName = document.getElementById('item_name').value;
            const rak = 'Rak ' + String.fromCharCode(65 + Math.floor(Math.random() * 10)); // A-J
            const level = 'Level ' + (1 + Math.floor(Math.random() * 5)); // 1-5

            document.getElementById('lokasiRak').innerText = `${rak}, ${level}`;
            document.getElementById('rekomendasiResult').classList.remove('d-none');
            document.getElementById('taruhBarangBtn').classList.remove('d-none');

            // Simpan sementara di attribute tombol
            const btn = document.getElementById('taruhBarangBtn');
            btn.setAttribute('data-rak', rak);
            btn.setAttribute('data-level', level);
        });

        // Simulasi penempatan barang
        document.getElementById('taruhBarangBtn').addEventListener('click', function () {
            const rak = this.getAttribute('data-rak').split(' ')[1]; // 'Rak D' → 'D'
            const level = parseInt(this.getAttribute('data-level').split(' ')[1]); // 'Level 3' → 3

            // Cari elemen grid berdasarkan rak & level
            const allBoxes = document.querySelectorAll(`[data-rak="Rak ${rak}"][data-level="Level ${level}"]`);

            // Tandai pertama yang kosong
            for (const box of allBoxes) {
                if (box.classList.contains('status-kosong')) {
                    box.classList.remove('status-kosong');
                    box.classList.add('terpakai'); // ubah ke status terpakai
                    break;
                }
            }

            // Sembunyikan tombol & reset input
            document.getElementById('taruhBarangBtn').classList.add('d-none');
            document.getElementById('item_name').value = '';
            alert(`Barang berhasil ditempatkan di Rak ${rak}, Level ${level}.`);
        });

        // Manual Placement
        document.getElementById('manualForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const item = document.getElementById('manual_item_name').value;
            const rak = document.getElementById('manual_rak').value;
            const level = document.getElementById('manual_level').value;

            const boxes = document.querySelectorAll(`[data-rak="Rak ${rak}"][data-level="Level ${level}"]`);
            for (const box of boxes) {
                if (box.classList.contains('status-kosong')) {
                    box.classList.remove('status-kosong');
                    box.classList.add('terpakai');
                    alert(`Barang "${item}" berhasil ditempatkan di Rak ${rak}, Level ${level}.`);
                    return;
                }
            }

            alert(`Tidak ada slot kosong di Rak ${rak}, Level ${level}.`);
        });

        document.getElementById('hapusBarangForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const rak = document.getElementById('hapus_rak').value;
            const level = document.getElementById('hapus_level').value;

            // Temukan kotak terisi pertama di rak/level itu
            const allBoxes = document.querySelectorAll(`[data-rak="Rak ${rak}"][data-level="Level ${level}"]`);
            for (const box of allBoxes) {
                if (box.classList.contains('terpakai') || box.classList.contains('penuh')) {
                    box.classList.remove('terpakai', 'penuh');
                    box.classList.add('status-kosong');
                    alert(`Barang berhasil dikeluarkan dari Rak ${rak}, Level ${level}`);
                    break;
                }
            }

            // Reset form
            this.reset();
        });

    </script>
@endsection