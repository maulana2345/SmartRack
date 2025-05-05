@extends('dashboard.main')
@section('content')
<div class="container">
    <h4>Edit Barang</h4>
    <form action="{{ route('barang.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('barang.form', ['item' => $item])
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
