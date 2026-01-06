@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card stat-card stat-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Jumlah Tapak</h6>
                        <h2 class="mb-0">{{ $stats['total_camps'] }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-campground fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Tapak Diluluskan</h6>
                        <h2 class="mb-0">{{ $stats['approved_camps'] }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-check-circle fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Penyerahan Pending</h6>
                        <h2 class="mb-0">{{ $stats['pending_submissions'] }}</h2>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-clock fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Jumlah Pengguna</h6>
                        <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-users fa-3x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Submissions -->
<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Penyerahan Terkini</h5>
            </div>
            <div class="card-body">
                @if($recentSubmissions->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentSubmissions as $submission)
                            <a href="{{ route('admin.submissions.show', $submission) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            {{ $submission->type === 'new_camp' ? 'Tapak Baru' : 'Edit Tapak' }}
                                        </h6>
                                        <p class="mb-1 small text-muted">
                                            Oleh: {{ $submission->submitter->name }}
                                        </p>
                                        <small class="text-muted">
                                            {{ $submission->submitted_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $submission->status === 'pending' ? 'warning' : ($submission->status === 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center py-4">Tiada penyerahan terkini</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.submissions.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua Penyerahan
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Camps -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tapak Terkini</h5>
            </div>
            <div class="card-body">
                @if($recentCamps->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentCamps as $camp)
                            <a href="{{ route('camps.show', $camp) }}" target="_blank"
                               class="list-group-item list-group-item-action">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $camp->name }}</h6>
                                        <p class="mb-1 small text-muted">{{ $camp->state }}</p>
                                        <small class="text-muted">
                                            {{ $camp->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $camp->status === 'approved' ? 'success' : ($camp->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($camp->status) }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center py-4">Tiada tapak terkini</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.camps.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua Tapak
                </a>
            </div>
        </div>
    </div>
</div>
@endsection