<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="fas fa-sign-in-alt"></i>
                    @if (app()->getLocale() == 'ms')
                        Log Masuk
                    @else
                        Login
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

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="login_email" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="login_email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="your@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="login_password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            id="login_password" name="password" required placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">
                            @if (app()->getLocale() == 'ms')
                                Ingat saya
                            @else
                                Remember me
                            @endif
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i>
                            @if (app()->getLocale() == 'ms')
                                Log Masuk
                            @else
                                Login
                            @endif
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center mb-3">
                        <a href="{{ route('password.request') }}" class="text-muted small">
                            @if (app()->getLocale() == 'ms')
                                Lupa kata laluan?
                            @else
                                Forgot your password?
                            @endif
                        </a>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <span class="text-muted">
                            @if (app()->getLocale() == 'ms')
                                Belum ada akaun?
                            @else
                                Don't have an account?
                            @endif
                        </span>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal"
                            data-bs-dismiss="modal">
                            @if (app()->getLocale() == 'ms')
                                Daftar sekarang
                            @else
                                Register now
                            @endif
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
