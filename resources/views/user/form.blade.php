<div class="mb-3">
    <label>Nama Pengguna</label>
    <input type="text" name="nama_pengguna" class="form-control" value="{{ old('nama_pengguna', $user->nama_pengguna ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-select" required>
        @foreach(['admin', 'user'] as $role)
            <option value="{{ $role }}" @selected(old('role', $user->role ?? '') == $role)>
                {{ ucfirst($role) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Password @if(isset($user))<small>(kosongkan jika tidak diubah)</small>@endif</label>
    <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>
