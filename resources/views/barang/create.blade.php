@extends('dashboard.main')
@section('content')
    <div class="container">
        <h4>Tambah Barang</h4>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            @include('barang.form')
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection