@extends('dashboard.main')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <h5 class="card-title fw-semibold mb-4">Log Aktivitas</h5>
                <div class="table-responsive">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Cari</label>
                            <input type="text" name="search" class="form-control"
                            placeholder="Cari aktivitas...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Aktivitas</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection