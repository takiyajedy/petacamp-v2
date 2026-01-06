@extends('layouts.admin')

@section('page-title', 'Senarai Penyerahan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Penyerahan</h5>
            
            <!-- Filter -->
            <div>
                <form action="{{ route('admin.submissions.index') }}" method="GET" class="d-inline">
                    <select name="status" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        @if($submissions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis</th>
                            <th>Tapak</th>
                            <th>Penghantar</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $submission->type === 'new_camp' ? 'Baru' : 'Edit' }}
                                    </span>
                                </td>
                                <td>
                                    @if($submission->camp)
                                        <a href="{{ route('camps.show', $submission->camp) }}" target="_blank">
                                            {{ $submission->camp->name }}
                                        </a>
                                    @else
                                        <em>{{ $submission->data['name'] ?? 'N/A' }}</em>
                                    @endif
                                </td>
                                <td>{{ $submission->submitter->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $submission->status === 'pending' ? 'warning' : ($submission->status === 'approved' ? 'success' : 'danger') }}">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </td>
                                <td>{{ $submission->submitted_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.submissions.show', $submission) }}" 
                                       class="btn btn-sm btn-primary">
                                        Lihat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $submissions->links() }}
            </div>
        @else
            <p class="text-muted text-center py-5">Tiada penyerahan dijumpai</p>
        @endif
    </div>
</div>
@endsection