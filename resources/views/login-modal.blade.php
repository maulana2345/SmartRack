<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-light border-bottom-0">
                <h5 class="modal-title fw-semibold" id="loginModalLabel">Login ke <span class="text"
                        style="color: #009CA6;">SmartRack</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4 pt-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3 mt-4">
                        <label for="email" class="form-label text-secondary">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" required autofocus placeholder="masukkan email anda" style="border-radius: 8px;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-secondary">Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5 @error('password') is-invalid @enderror"
                                name="password" id="password" required placeholder="••••••••" style="border-radius: 8px;">
                            <span class="position-absolute top-50 end-0 translate-middle-y pe-3"
                                style="cursor: pointer;" id="togglePassword">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                    @endif

                    <!-- Button -->
                    <button type="submit" class="btn w-100 mt-3"
                        style="background-color: #ff7043; color: white; border: none; border-radius: 8px;">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Eye Icon Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>