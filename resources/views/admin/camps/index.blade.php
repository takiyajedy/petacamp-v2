@extends('layouts.admin')

@section('page-title', 'Senarai Tapak Perkhemahan')

@section('content')

<!-- Global Delete Function - Put BEFORE table -->
<script>
window.confirmDeleteCamp = function(campId, campName) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Adakah anda pasti?',
            html: 'Anda akan memadam tapak<br><strong>"' + campName + '"</strong><br><br>Tindakan ini tidak boleh dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash"></i> Ya, Padam!',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sila tunggu',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                document.getElementById('deleteForm-' + campId).submit();
            }
        });
    } else {
        // Fallback
        if (confirm('Adakah anda pasti mahu memadam tapak "' + campName + '"?')) {
            document.getElementById('deleteForm-' + campId).submit();
        }
    }
};
</script>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Senarai Tapak</h2>
    <div>
        <form action="{{ route('admin.camps.index') }}" method="GET" class="d-inline-block">
            <div class="input-group">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if ($camps->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Dicipta Oleh</th>
                            <th>Status</th>
                            <th>Tontonan</th>
                            <th>Tarikh</th>
                            <th style="width: 200px;">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($camps as $camp)
                            <tr>
                                <td>{{ $camp->id }}</td>
                                <td>
                                    @if ($camp->image)
                                        <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->name }}"
                                            class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <i class="fas fa-campground text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $camp->name }}</strong>
                                    @if ($camp->is_featured)
                                        <span class="badge bg-warning text-dark ms-1">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                    @if ($camp->name_bm)
                                        <br><small class="text-muted">{{ $camp->name_bm }}</small>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt text-danger"></i> {{ $camp->state }}
                                    @if ($camp->city)
                                        <br><small class="text-muted">{{ $camp->city }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($camp->creator)
                                        {{ $camp->creator->name }}
                                        <br><small class="text-muted">{{ $camp->creator->email }}</small>
                                    @else
                                        <em class="text-muted">N/A</em>
                                    @endif
                                </td>
                                <td>
                                    @if ($camp->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($camp->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="fas fa-eye"></i> {{ number_format($camp->views_count) }}
                                </td>
                                <td>
                                    <small>{{ $camp->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('camps.show', $camp) }}" class="btn btn-sm btn-info"
                                            target="_blank" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.camps.edit', $camp) }}" class="btn btn-sm btn-primary"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.camps.destroy', $camp) }}" 
                                              method="POST" 
                                              id="deleteForm-{{ $camp->id }}"
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    class="btn btn-sm btn-danger"
                                                    onclick="confirmDeleteCamp({{ $camp->id }}, '{{ addslashes($camp->name) }}')"
                                                    title="Padam">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $camps->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-campground fa-4x text-muted mb-3"></i>
                <h5>Tiada tapak dijumpai</h5>
                <p class="text-muted">Tiada tapak yang sepadan dengan kriteria carian.</p>
            </div>
        @endif
    </div>
</div>
@endsection