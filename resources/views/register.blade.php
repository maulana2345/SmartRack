<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SmartRack | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('landpage/assets/img/favicons/logo2.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <style>
        .bg-image-vertical {
            background-color: #f8f9fa;
        }

        .login-image {
            background-image: url('{{ asset('assets/images/Login_SR.png') }}');
            background-size: cover;
            background-position: center;
            height: 100%;
            width: 100%;
        }

        .logo {
            width: 50px;
            height: auto;
            border-radius: 30px;
        }

        .form-container {
            margin-top: 50px;
        }

        .btn-gradien {
            background-color: #ff7043;
            color: white;
            border: none;
        }

        .btn-gradien:hover {
            background-color: #e85b32;
        }
    </style>
</head>

<body>
    <section class="vh-100 bg-image-vertical">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Bagian Gambar -->
                <div class="col-sm-6 d-none d-sm-block px-0">
                    <div class="login-image"></div>
                </div>

                <!-- Bagian Form Register -->
                <div class="col-sm-6 text-black d-flex justify-content-center align-items-center">
                    <div class="form-container">
                        <!-- Logo dan Judul -->
                        <div class="d-flex align-items-center mb-4">
                            <h1>SmartRack</h1>
                        </div>

                        <!-- Alerts -->
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                        @endif

                        <!-- Form Register -->
                        <form action="/register" method="POST" style="width: 23rem;">
                            @csrf

                            {{-- Name --}}
                            <!-- <div class="form-outline mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> -->

                            {{-- Username --}}
                            <div class="form-outline mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="nama_pengguna" id="nama_pengguna"
                                    class="form-control form-control-lg @error('nama_pengguna') is-invalid @enderror"
                                    value="{{ old('nama_pengguna') }}" required>
                                @error('nama_pengguna')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-outline mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-outline mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        required>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="form-outline mb-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control form-control-lg" required>
                            </div>

                            {{-- Button --}}
                            <button type="submit" class="btn btn-gradien btn-lg w-100 mb-3">Register</button>
                            <p class="text-center">Sudah punya akun? <a href="/login">Login di sini</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>

</html>
