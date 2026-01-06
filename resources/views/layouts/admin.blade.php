<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar" style="width: 250px;">
            <div class="px-3">
                <h4 class="text-white mb-4">
                    <i class="fas fa-shield-alt"></i> Admin Panel
                </h4>
                
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}" 
                       href="{{ route('admin.submissions.index') }}">
                        <i class="fas fa-inbox"></i> Penyerahan
                        @php
                            $pendingCount = \App\Models\Submission::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-warning text-dark ms-2">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.camps.*') ? 'active' : '' }}" 
                       href="{{ route('admin.camps.index') }}">
                        <i class="fas fa-campground"></i> Tapak
                    </a>
                    <a class="nav-link" href="{{ route('camps.index') }}">
                        <i class="fas fa-arrow-left"></i> Kembali ke Laman Utama
                    </a>
                    
                    <hr class="bg-light">
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100">
                            <i class="fas fa-sign-out-alt"></i> Log Keluar
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Bar -->
            <nav class="navbar navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">@yield('page-title', 'Dashboard')</span>
                    <span class="navbar-text">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </span>
                </div>
            </nav>

            <!-- SweetAlert Flash Messages -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berjaya!',
                            text: "{{ session('success') }}",
                            confirmButtonColor: '#2c5f2d',
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true
                        });
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ralat!',
                            text: "{{ session('error') }}",
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>
            @endif

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>