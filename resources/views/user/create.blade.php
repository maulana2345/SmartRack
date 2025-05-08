@extends('dashboard.main')

@section('content')
<div class="container">
    <h4>Tambah Pengguna</h4>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        @include('user.form')
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
