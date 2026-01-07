<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="registerModalLabel">
                    <i class="fas fa-user-plus"></i>
                    @if (app()->getLocale() == 'ms')
                        Daftar Akaun
                    @else
                        Register
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4">
                <div class="mb-3">
        <a href="{{ route('auth.google') }}" class="btn btn-outline-danger w-100 btn-lg">
            <i class="fab fa-google"></i> Continue with Google
        </a>
    </div>
    
    <!-- Divider -->
    <div class="position-relative my-3">
        <hr>
        <span class="position-absolute top-50 start-50 translate-middle px-2" 
              style="background-color: var(--bg-card); color: var(--text-muted);">
            or
        </span>
    </div>
                <form method="POST" action="{{ route('register') }}" id="registerForm">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="register_name" class="form-label">
                            <i class="fas fa-user"></i>
                            @if (app()->getLocale() == 'ms')
                                Nama
                            @else
                                Name
                            @endif
                        </label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                            id="register_name" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="John Doe">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="register_email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="register_email" name="email" value="{{ old('email') }}" required
                            placeholder="your@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="register_password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            id="register_password" name="password" required placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            @if (app()->getLocale() == 'ms')
                                Minimum 8 aksara
                            @else
                                Minimum 8 characters
                            @endif
                        </small>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="register_password_confirmation" class="form-label">
                            <i class="fas fa-lock"></i>
                            @if (app()->getLocale() == 'ms')
                                Sahkan Password
                            @else
                                Confirm Password
                            @endif
                        </label>
                        <input type="password" class="form-control form-control-lg" id="register_password_confirmation"
                            name="password_confirmation" required placeholder="••••••••">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus"></i>
                            @if (app()->getLocale() == 'ms')
                                Daftar
                            @else
                                Register
                            @endif
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <span class="text-muted">
                            @if (app()->getLocale() == 'ms')
                                Sudah ada akaun?
                            @else
                                Already have an account?
                            @endif
                        </span>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                            @if (app()->getLocale() == 'ms')
                                Log masuk
                            @else
                                Login
                            @endif
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
