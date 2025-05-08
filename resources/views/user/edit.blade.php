@extends('dashboard.main')

@section('content')
<div class="container">
    <h4>Edit Pengguna</h4>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        @include('user.form', ['user' => $user])
        <button class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
