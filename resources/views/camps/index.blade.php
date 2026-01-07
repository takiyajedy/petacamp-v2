@extends('layouts.app')

@section('title', 'Senarai Tapak Perkhemahan')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>🏕️ Cari Tapak Perkhemahan Anda</h1>
        <p>Direktori lengkap tapak perkhemahan di seluruh Malaysia</p>
        
        <!-- Search Form -->
        <form action="{{ route('camps.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-lg" 
                       placeholder="Cari tapak..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="state" class="form-select form-select-lg">
                    <option value="">Semua Negeri</option>
                    @foreach($states as $state)
                        <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                            {{ $state }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select form-select-lg">
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terkini</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light btn-lg w-100">
                    <i class="fas fa-search"></i> {{ __('app.camp.search_button') }}
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Filter Section -->
<section class="py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Kemudahan</h5>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#amenitiesFilter">
                <i class="fas fa-filter"></i> Tapis
            </button>
        </div>
        
        <div class="collapse" id="amenitiesFilter">
            <form action="{{ route('camps.index') }}" method="GET">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="state" value="{{ request('state') }}">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                
                <div class="row g-2">
                    @foreach($amenities as $amenity)
                        <div class="col-md-3 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="amenities[]" 
                                       value="{{ $amenity->id }}" id="amenity{{ $amenity->id }}"
                                       {{ in_array($amenity->id, request('amenities', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                    <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Tapis</button>
                    <a href="{{ route('camps.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Camps Listing -->
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Ditemui {{ $camps->total() }} tapak</h4>
            <a href="{{ route('camps.map') }}" class="btn btn-outline-primary">
                <i class="fas fa-map"></i> Lihat Peta
            </a>
        </div>

        @if($camps->count() > 0)
            <div class="row g-4">
                @foreach($camps as $camp)
                    <div class="col-md-4">
                        <div class="card camp-card">
                            @if($camp->image)
                                <img src="{{ asset('storage/' . $camp->image) }}" class="card-img-top" alt="{{ $camp->name }}">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-campground fa-4x text-white"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">{{ $camp->name }}</h5>
                                <p class="card-text">
                                    <i class="fas fa-map-marker-alt text-danger"></i> {{ $camp->state }}
                                </p>
                                
                                @if($camp->price_per_night)
                                    <p class="card-text">
                                        <strong>RM{{ number_format($camp->price_per_night, 2) }}</strong> / malam
                                    </p>
                                @endif
                                
                                <!-- Amenities -->
                                <div class="mb-2">
                                    @foreach($camp->amenities->take(3) as $amenity)
                                        <span class="badge bg-light text-dark">
                                            <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                        </span>
                                    @endforeach
                                    @if($camp->amenities->count() > 3)
                                        <span class="badge bg-light text-dark">+{{ $camp->amenities->count() - 3 }}</span>
                                    @endif
                                </div>
                                
                                <a href="{{ route('camps.show', $camp) }}" class="btn btn-primary w-100">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $camps->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h4>Tiada tapak dijumpai</h4>
                <p>Cuba ubah kriteria carian anda</p>
            </div>
        @endif
    </div>
</section>
@endsection