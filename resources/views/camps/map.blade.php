@extends('layouts.app')

@section('title', 'Peta Tapak Perkhemahan')

@section('content')
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tapis Negeri</h5>
                        <form action="{{ route('camps.map') }}" method="GET">
                            <select name="state" class="form-select mb-3" onchange="this.form.submit()">
                                <option value="">Semua Negeri</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ request('state') == $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <hr>

                        <h6>Jumlah Tapak: {{ $camps->count() }}</h6>
                        
                        <a href="{{ route('camps.index') }}" class="btn btn-outline-primary w-100 mt-3">
                            <i class="fas fa-list"></i> Lihat Senarai
                        </a>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="col-md-9">
                <div id="mainMap" class="map-container"></div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const camps = @json($camps);
        window.initMap('mainMap', camps, {
            center: [4.2105, 101.9758],
            zoom: 7
        });
    });
</script>
@endpush
@endsection