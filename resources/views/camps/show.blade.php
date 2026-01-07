@extends('layouts.app')

@section('title', $camp->name)

@section('content')
<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('camps.index') }}">Senarai</a></li>
                <li class="breadcrumb-item active">{{ $camp->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Image -->
                @if($camp->image)
                    <img src="{{ asset('storage/' . $camp->image) }}" class="img-fluid rounded mb-4" alt="{{ $camp->name }}">
                @else
                    <div class="bg-secondary rounded mb-4 d-flex align-items-center justify-content-center" style="height: 400px;">
                        <i class="fas fa-campground fa-5x text-white"></i>
                    </div>
                @endif

                <!-- Title & Basic Info -->
                <h1>{{ $camp->name }}</h1>
                @if($camp->name_bm && $camp->name_bm !== $camp->name)
                    <p class="text-muted">{{ $camp->name_bm }}</p>
                @endif

                <div class="mb-4">
                    <span class="badge bg-primary">{{ $camp->state }}</span>
                    <span class="text-muted ms-2">
                        <i class="fas fa-eye"></i> {{ number_format($camp->views_count) }} tontonan
                    </span>
                </div>

                <!-- Description -->
                @if($camp->description)
                    <div class="mb-4">
                        <h4>Tentang Tapak Ini</h4>
                        <p>{{ $camp->description }}</p>
                    </div>
                @endif

                <!-- Amenities -->
                @if($camp->amenities && $camp->amenities->count() > 0)
                    <div class="mb-4">
                        <h4>Kemudahan</h4>
                        <div class="row g-2">
                            @foreach($camp->amenities as $amenity)
                                <div class="col-md-6">
                                    <div  class="amenity-badge">
                                        <i class="fas {{ $amenity->icon }}"></i>
                                        {{ $amenity->label_bm }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Activities -->
                @if($camp->activities && $camp->activities->count() > 0)
                    <div class="mb-4">
                        <h4>Aktiviti & Acara</h4>
                        @foreach($camp->activities as $activity)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h6>{{ $activity->title }}</h6>
                                    @if($activity->description)
                                        <p class="small mb-2">{{ $activity->description }}</p>
                                    @endif
                                    <span class="badge bg-info">{{ ucfirst($activity->type) }}</span>
                                    @if($activity->start_date)
                                        <span class="text-muted small">
                                            <i class="fas fa-calendar"></i> 
                                            {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Location Map -->
                <div class="mb-4">
                    <h4>Lokasi</h4>
                    <div id="campMap" style="height: 500px; width: 100%; border-radius: 8px; overflow: hidden;"></div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">Maklumat</h5>
                        
                        <!-- Address -->
                        <div class="mb-3">
                            <h6><i class="fas fa-map-marker-alt"></i> Alamat</h6>
                            <p class="small">{{ $camp->address }}</p>
                        </div>

                        <!-- Contact -->
                        @if($camp->phone || $camp->email)
                            <div class="mb-3">
                                <h6><i class="fas fa-phone"></i> Hubungi</h6>
                                @if($camp->phone)
                                    <p class="small mb-1">
                                        <a href="tel:{{ $camp->phone }}">{{ $camp->phone }}</a>
                                    </p>
                                @endif
                                @if($camp->email)
                                    <p class="small mb-1">
                                        <a href="mailto:{{ $camp->email }}">{{ $camp->email }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif

                        <!-- Website -->
                        @if($camp->website)
                            <div class="mb-3">
                                <a href="{{ $camp->website }}" target="_blank" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-external-link-alt"></i> Lawati Laman Web
                                </a>
                            </div>
                        @endif

                        <!-- Pricing -->
                        @if($camp->price_per_night)
                            <div class="mb-3">
                                <h6><i class="fas fa-dollar-sign"></i> Harga</h6>
                                <p class="h4 text-primary">RM{{ number_format($camp->price_per_night, 2) }}</p>
                                <p class="small text-muted">per malam</p>
                            </div>
                        @endif

                        <!-- Capacity -->
                        @if($camp->max_capacity)
                            <div class="mb-3">
                                <h6><i class="fas fa-users"></i> Kapasiti</h6>
                                <p class="small">Maksimum {{ $camp->max_capacity }} orang</p>
                            </div>
                        @endif

                        <!-- Actions -->
                        <hr>
                        @auth
                            @if(auth()->id() === $camp->created_by || auth()->user()->isAdmin())
                                <a href="{{ route('camps.edit', $camp) }}" class="btn btn-warning w-100 mb-2">
                                    <i class="fas fa-edit"></i> Cadang Perubahan
                                </a>
                            @endif
                        @endauth

                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $camp->latitude }},{{ $camp->longitude }}" 
                           target="_blank" class="btn btn-success w-100">
                            <i class="fas fa-directions"></i> Arah ke Sini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if Leaflet is available
    if (typeof L === 'undefined') {
        console.error('Leaflet is not loaded!');
        return;
    }
    
    const campData = {
        id: {{ $camp->id }},
        name: "{{ addslashes($camp->name) }}",
        latitude: {{ $camp->latitude }},
        longitude: {{ $camp->longitude }},
        state: "{{ addslashes($camp->state) }}"
    };
    
    console.log('Camp coordinates:', campData.latitude, campData.longitude);
    
    // Initialize map
    const map = L.map('campMap').setView([campData.latitude, campData.longitude], 15);
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    // Add marker
    const marker = L.marker([campData.latitude, campData.longitude]).addTo(map);
    marker.bindPopup('<b>' + campData.name + '</b><br>' + campData.state).openPopup();
    
    // Force resize
    setTimeout(function() {
        map.invalidateSize();
    }, 100);
});
</script>
@endpush
@endsection