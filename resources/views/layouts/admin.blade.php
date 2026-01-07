<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        /* Admin Tab Navigation Styles */
        .admin-tabs {
            background-color: var(--bg-card);
            border-bottom: 2px solid var(--border-color);
            padding: 0;
        }
        
        .admin-tabs .nav-tabs {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .admin-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: var(--text-secondary);
            padding: 1rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: transparent;
        }
        
        .admin-tabs .nav-link:hover {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
            background-color: var(--bg-secondary);
        }
        
        .admin-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
            background-color: transparent;
            font-weight: 600;
        }
        
        .admin-tabs .nav-link i {
            margin-right: 0.5rem;
        }
        
        .admin-tabs .badge {
            margin-left: 0.5rem;
        }
        
        /* Sidebar styling */
        .admin-sidebar {
            background-color: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
        }
        
        .admin-sidebar .nav-link {
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .admin-sidebar .nav-link:hover {
            background-color: var(--bg-card);
        }
        
        .admin-sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Top bar controls */
        .top-bar-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .control-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        
        .control-btn:hover {
            background-color: var(--bg-secondary);
            border-color: var(--primary-color);
        }
        
        .control-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        /* Language dropdown in top bar */
        .lang-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .lang-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 0.5rem;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 150px;
            display: none;
            z-index: 1000;
        }
        
        .lang-dropdown-menu.show {
            display: block;
        }
        
        .lang-dropdown-item {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        
        .lang-dropdown-item:hover {
            background-color: var(--bg-secondary);
        }
        
        .lang-dropdown-item.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .lang-dropdown-item i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar" style="width: 250px;">
            <div class="p-3">
                <h4 class="mb-4" style="color: var(--primary-color);">
                    <i class="fas fa-campground"></i> <strong>PetaCamp</strong>
                </h4>
                
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> 
                        @if(app()->getLocale() == 'ms')
                            Papan Pemuka
                        @else
                            Dashboard
                        @endif
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}" 
                       href="{{ route('admin.submissions.index') }}">
                        <i class="fas fa-inbox"></i> 
                        @if(app()->getLocale() == 'ms')
                            Penyerahan
                        @else
                            Submissions
                        @endif
                        @php
                            $pendingCount = \App\Models\Submission::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-warning text-dark ms-2">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.camps.*') ? 'active' : '' }}" 
                       href="{{ route('admin.camps.index') }}">
                        <i class="fas fa-campground"></i> 
                        @if(app()->getLocale() == 'ms')
                            Tapak
                        @else
                            Camps
                        @endif
                    </a>
                    <a class="nav-link" href="{{ route('camps.index') }}">
                        <i class="fas fa-arrow-left"></i> 
                        @if(app()->getLocale() == 'ms')
                            Kembali ke Laman Utama
                        @else
                            Back to Main Site
                        @endif
                    </a>
                    
                    <hr style="border-color: var(--border-color);">
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100">
                            <i class="fas fa-sign-out-alt"></i> 
                            @if(app()->getLocale() == 'ms')
                                Log Keluar
                            @else
                                Logout
                            @endif
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Bar with Controls -->
            <nav class="navbar navbar-light bg-white border-bottom" style="background-color: var(--bg-card) !important; border-color: var(--border-color) !important;">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1" style="color: var(--text-primary);">
                        @yield('page-title', app()->getLocale() == 'ms' ? 'Papan Pemuka' : 'Dashboard')
                    </span>
                    
                    <!-- Right side controls -->
                    <div class="top-bar-controls">
                        <!-- Dark Mode Toggle -->
                        <button id="darkModeToggle" 
                                class="control-btn" 
                                aria-label="Toggle dark mode"
                                title="Toggle Dark Mode">
                            <i class="fas fa-moon"></i>
                        </button>
                        
                        <!-- Language Switcher -->
                        <div class="lang-dropdown">
                            <button class="control-btn" 
                                    id="langDropdownBtn"
                                    onclick="toggleLangDropdown()">
                                <i class="fas fa-globe"></i>
                                @if(app()->getLocale() == 'ms')
                                    BM
                                @else
                                    EN
                                @endif
                            </button>
                            <div class="lang-dropdown-menu" id="langDropdownMenu">
                                <a href="{{ route('language.switch', 'en') }}" 
                                   class="lang-dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                    <i class="fas fa-check {{ app()->getLocale() == 'en' ? '' : 'invisible' }}"></i>
                                    English
                                </a>
                                <a href="{{ route('language.switch', 'ms') }}" 
                                   class="lang-dropdown-item {{ app()->getLocale() == 'ms' ? 'active' : '' }}">
                                    <i class="fas fa-check {{ app()->getLocale() == 'ms' ? '' : 'invisible' }}"></i>
                                    Bahasa Melayu
                                </a>
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                        class="rounded-circle me-1" style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle"></i>
                                @endif
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user"></i> {{ __('app.nav.profile') }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('app.nav.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </nav>

            <!-- Tab Navigation Header -->
            {{-- <div class="admin-tabs">
                <div class="container-fluid">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                @if(app()->getLocale() == 'ms')
                                    Papan Pemuka
                                @else
                                    Dashboard
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.submissions.*') ? 'active' : '' }}" 
                               href="{{ route('admin.submissions.index') }}">
                                <i class="fas fa-inbox"></i>
                                @if(app()->getLocale() == 'ms')
                                    Penyerahan
                                @else
                                    Submissions
                                @endif
                                @php
                                    $pendingCount = \App\Models\Submission::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span class="badge bg-warning text-dark">{{ $pendingCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.camps.*') ? 'active' : '' }}" 
                               href="{{ route('admin.camps.index') }}">
                                <i class="fas fa-campground"></i>
                                @if(app()->getLocale() == 'ms')
                                    Tapak
                                @else
                                    Camps
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                               href="#">
                                <i class="fas fa-users"></i>
                                @if(app()->getLocale() == 'ms')
                                    Pengguna
                                @else
                                    Users
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" 
                               href="#">
                                <i class="fas fa-cog"></i>
                                @if(app()->getLocale() == 'ms')
                                    Tetapan
                                @else
                                    Settings
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}

            <!-- SweetAlert Flash Messages -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: "{{ app()->getLocale() == 'ms' ? 'Berjaya!' : 'Success!' }}",
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
                            title: "{{ app()->getLocale() == 'ms' ? 'Ralat!' : 'Error!' }}",
                            text: "{{ session('error') }}",
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    });
                </script>
            @endif

            <!-- Page Content -->
            <main class="p-4" style="background-color: var(--bg-primary);">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Language Dropdown Script -->
    <script>
        function toggleLangDropdown() {
            const menu = document.getElementById('langDropdownMenu');
            menu.classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            if (!e.target.matches('#langDropdownBtn') && !e.target.closest('#langDropdownBtn')) {
                const menu = document.getElementById('langDropdownMenu');
                if (menu.classList.contains('show')) {
                    menu.classList.remove('show');
                }
            }
        });
    </script>
</body>
</html>