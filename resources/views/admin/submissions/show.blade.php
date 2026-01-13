@extends('layouts.admin')

@section('page-title', 'Detail Penyerahan')

@section('content')

<!-- ✅ SCRIPT AT TOP - BEFORE CONTENT -->
<script>
// Global functions for approve/reject
window.approveSubmission = function(submissionId, route) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Luluskan Penyerahan?',
            text: 'Penyerahan ini akan diluluskan dan tapak akan diwujudkan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-check"></i> Ya, Luluskan!',
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
                document.getElementById('approveForm').submit();
            }
        });
    } else {
        if (confirm('Luluskan penyerahan ini?')) {
            document.getElementById('approveForm').submit();
        }
    }
};

window.rejectSubmission = async function(route, csrfToken) {
    if (typeof Swal !== 'undefined') {
        const { value: reason } = await Swal.fire({
            title: 'Tolak Penyerahan',
            input: 'textarea',
            inputLabel: 'Sebab penolakan',
            inputPlaceholder: 'Sila nyatakan sebab penolakan...',
            inputAttributes: {
                'aria-label': 'Sebab penolakan',
                'rows': 4
            },
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-times-circle"></i> Tolak',
            cancelButtonText: '<i class="fas fa-arrow-left"></i> Batal',
            reverseButtons: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Sila nyatakan sebab penolakan!'
                }
                if (value.length < 10) {
                    return 'Sebab penolakan terlalu pendek (minimum 10 aksara)'
                }
            }
        });

        if (reason) {
            Swal.fire({
                title: 'Memproses...',
                text: 'Sila tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = route;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            const reasonInput = document.createElement('input');
            reasonInput.type = 'hidden';
            reasonInput.name = 'rejection_reason';
            reasonInput.value = reason;
            
            form.appendChild(csrfInput);
            form.appendChild(reasonInput);
            document.body.appendChild(form);
            form.submit();
        }
    } else {
        // Fallback
        const reason = prompt('Sebab penolakan:');
        if (reason && reason.length >= 10) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = route;
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            
            const reasonInput = document.createElement('input');
            reasonInput.type = 'hidden';
            reasonInput.name = 'rejection_reason';
            reasonInput.value = reason;
            
            form.appendChild(csrfInput);
            form.appendChild(reasonInput);
            document.body.appendChild(form);
            form.submit();
        } else {
            alert('Sebab penolakan diperlukan (minimum 10 aksara)');
        }
    }
};
</script>

<div class="mb-4">
    <a href="{{ route('admin.submissions.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-{{ $submission->status === 'pending' ? 'warning' : ($submission->status === 'approved' ? 'success' : 'danger') }} text-white">
                <h5 class="mb-0">
                    <i class="fas fa-{{ $submission->type === 'new_camp' ? 'plus-circle' : 'edit' }}"></i>
                    {{ $submission->type === 'new_camp' ? 'Tapak Baru' : 'Edit Tapak' }}
                    - Status: {{ ucfirst($submission->status) }}
                </h5>
            </div>
            <div class="card-body">
                <!-- Submission Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Dihantar oleh:</strong> {{ $submission->submitter->name }}</p>
                        <p><small class="text-muted">{{ $submission->submitter->email }}</small></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tarikh:</strong> {{ $submission->submitted_at->format('d/m/Y H:i') }}</p>
                        <p><small class="text-muted">{{ $submission->submitted_at->diffForHumans() }}</small></p>
                    </div>
                </div>

                @if($submission->reviewed_by)
                    <div class="alert alert-info">
                        <strong>Disemak oleh:</strong> {{ $submission->reviewer->name }}<br>
                        <strong>Tarikh semakan:</strong> {{ $submission->reviewed_at->format('d/m/Y H:i') }}
                        
                        @if($submission->rejection_reason)
                            <hr>
                            <strong>Sebab ditolak:</strong><br>
                            {{ $submission->rejection_reason }}
                        @endif
                    </div>
                @endif

                <hr>

                <!-- Data Preview -->
                <h5 class="mb-3">Maklumat Tapak</h5>

                <!-- Image -->
                @if(isset($submission->data['image']) || $submission->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . ($submission->image ?? $submission->data['image'])) }}" 
                             alt="Camp Image" 
                             class="img-fluid rounded"
                             style="max-height: 400px;">
                    </div>
                @endif

                <!-- Name -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6>Nama (English)</h6>
                        <p>{{ $submission->data['name'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Nama (Bahasa Melayu)</h6>
                        <p>{{ $submission->data['name_bm'] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Location -->
                <h6 class="mt-4">Lokasi</h6>
                <p><strong>Alamat:</strong> {{ $submission->data['address'] ?? 'N/A' }}</p>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Negeri:</strong> {{ $submission->data['state'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Bandar:</strong> {{ $submission->data['city'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Poskod:</strong> {{ $submission->data['postcode'] ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Latitude:</strong> {{ $submission->data['latitude'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Longitude:</strong> {{ $submission->data['longitude'] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if(isset($submission->data['description']))
                    <h6 class="mt-4">Penerangan (English)</h6>
                    <p>{{ $submission->data['description'] }}</p>
                @endif

                @if(isset($submission->data['description_bm']))
                    <h6 class="mt-4">Penerangan (Bahasa Melayu)</h6>
                    <p>{{ $submission->data['description_bm'] }}</p>
                @endif

                <!-- Contact -->
                <h6 class="mt-4">Maklumat Perhubungan</h6>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Telefon:</strong> {{ $submission->data['phone'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Email:</strong> {{ $submission->data['email'] ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Website:</strong> {{ $submission->data['website'] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Pricing -->
                @if(isset($submission->data['price_per_night']) || isset($submission->data['price_per_person']))
                    {{-- <h6 class="mt-4">Harga</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Harga per malam:</strong> RM{{ number_format($submission->data['price_per_night'] ?? 0, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Harga per orang:</strong> RM{{ number_format($submission->data['price_per_person'] ?? 0, 2) }}</p>
                        </div>
                    </div> --}}
                @endif

                <!-- Capacity -->
                @if(isset($submission->data['max_capacity']) || isset($submission->data['tent_sites']))
                    <h6 class="mt-4">Kapasiti</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Kapasiti max:</strong> {{ $submission->data['max_capacity'] ?? 'N/A' }} orang</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tapak khemah:</strong> {{ $submission->data['tent_sites'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                @endif

                <!-- Amenities -->
                @if(isset($submission->data['amenities']) && is_array($submission->data['amenities']) && count($submission->data['amenities']) > 0)
                    <h6 class="mt-4">Kemudahan</h6>
                    <div class="row">
                        @foreach($submission->data['amenities'] as $amenityId)
                            @php
                                $amenity = \App\Models\Amenity::find($amenityId);
                            @endphp
                            @if($amenity)
                                <div class="col-md-4 mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                <!-- Raw Data (for debugging) -->
                <div class="mt-5">
                    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#rawData">
                        <i class="fas fa-code"></i> Show Raw Data
                    </button>
                    <div class="collapse mt-2" id="rawData">
                        <pre class="bg-light p-3 rounded"><code>{{ json_encode($submission->data, JSON_PRETTY_PRINT) }}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Actions Card -->
        @if($submission->status === 'pending')
            <div class="card mb-3">
                <div class="card-header bg-warning text-white">
                    <h6 class="mb-0"><i class="fas fa-tasks"></i> Tindakan</h6>
                </div>
                <div class="card-body">
                    <!-- Approve Button -->
                    <form action="{{ route('admin.submissions.approve', $submission) }}" 
                          method="POST" 
                          id="approveForm">
                        @csrf
                        <button type="button" 
                                class="btn btn-success w-100 mb-2"
                                onclick="approveSubmission({{ $submission->id }}, '{{ route('admin.submissions.approve', $submission) }}')">
                            <i class="fas fa-check-circle"></i> Luluskan
                        </button>
                    </form>

                    <!-- Reject Button -->
                    <button type="button" 
                            class="btn btn-danger w-100"
                            onclick="rejectSubmission('{{ route('admin.submissions.reject', $submission) }}', '{{ csrf_token() }}')">
                        <i class="fas fa-times-circle"></i> Tolak
                    </button>
                </div>
            </div>
        @endif

        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle"></i> Maklumat Penyerahan</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $submission->id }}</td>
                    </tr>
                    <tr>
                        <th>Jenis:</th>
                        <td>
                            <span class="badge bg-info">
                                {{ $submission->type === 'new_camp' ? 'Tapak Baru' : 'Edit Tapak' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <span class="badge bg-{{ $submission->status === 'pending' ? 'warning' : ($submission->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($submission->status) }}
                            </span>
                        </td>
                    </tr>
                    @if($submission->camp)
                        <tr>
                            <th>Tapak Asal:</th>
                            <td>
                                <a href="{{ route('camps.show', $submission->camp) }}" target="_blank">
                                    {{ $submission->camp->name }}
                                </a>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection