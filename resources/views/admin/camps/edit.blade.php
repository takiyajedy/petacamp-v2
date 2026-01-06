@extends('layouts.admin')

@section('page-title', 'Edit Tapak')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.camps.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Tapak: {{ $camp->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.camps.update', $camp) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <h6 class="border-bottom pb-2 mb-3">Maklumat Asas</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama (English) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $camp->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="name_bm" class="form-label">Nama (Bahasa Melayu)</label>
                                <input type="text" class="form-control @error('name_bm') is-invalid @enderror"
                                    id="name_bm" name="name_bm" value="{{ old('name_bm', $camp->name_bm) }}">
                                @error('name_bm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Lokasi</h6>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                required>{{ old('address', $camp->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="state" class="form-label">Negeri <span class="text-danger">*</span></label>
                                <select class="form-select @error('state') is-invalid @enderror" id="state"
                                    name="state" required>
                                    <option value="">Pilih Negeri</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state }}"
                                            {{ old('state', $camp->state) == $state ? 'selected' : '' }}>
                                            {{ $state }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="city" class="form-label">Bandar</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city" value="{{ old('city', $camp->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="postcode" class="form-label">Poskod</label>
                                <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                                    id="postcode" name="postcode" value="{{ old('postcode', $camp->postcode) }}">
                                @error('postcode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label">Latitude <span class="text-danger">*</span></label>
                                <input type="number" step="0.00000001"
                                    class="form-control @error('latitude') is-invalid @enderror" id="latitude"
                                    name="latitude" value="{{ old('latitude', $camp->latitude) }}" required>
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="longitude" class="form-label">Longitude <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.00000001"
                                    class="form-control @error('longitude') is-invalid @enderror" id="longitude"
                                    name="longitude" value="{{ old('longitude', $camp->longitude) }}" required>
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Descriptions -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Penerangan</h6>

                        <div class="mb-3">
                            <label for="description" class="form-label">Penerangan (English)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="4">{{ old('description', $camp->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description_bm" class="form-label">Penerangan (Bahasa Melayu)</label>
                            <textarea class="form-control @error('description_bm') is-invalid @enderror" id="description_bm"
                                name="description_bm" rows="4">{{ old('description_bm', $camp->description_bm) }}</textarea>
                            @error('description_bm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Maklumat Perhubungan</h6>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $camp->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $camp->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror"
                                    id="website" name="website" value="{{ old('website', $camp->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pricing & Capacity -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Harga & Kapasiti</h6>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="price_per_night" class="form-label">Harga/Malam (RM)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('price_per_night') is-invalid @enderror"
                                    id="price_per_night" name="price_per_night"
                                    value="{{ old('price_per_night', $camp->price_per_night) }}">
                                @error('price_per_night')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="price_per_person" class="form-label">Harga/Orang (RM)</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('price_per_person') is-invalid @enderror"
                                    id="price_per_person" name="price_per_person"
                                    value="{{ old('price_per_person', $camp->price_per_person) }}">
                                @error('price_per_person')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="max_capacity" class="form-label">Kapasiti Max</label>
                                <input type="number" class="form-control @error('max_capacity') is-invalid @enderror"
                                    id="max_capacity" name="max_capacity"
                                    value="{{ old('max_capacity', $camp->max_capacity) }}">
                                @error('max_capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="tent_sites" class="form-label">Tapak Khemah</label>
                                <input type="number" class="form-control @error('tent_sites') is-invalid @enderror"
                                    id="tent_sites" name="tent_sites"
                                    value="{{ old('tent_sites', $camp->tent_sites) }}">
                                @error('tent_sites')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Amenities -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Kemudahan</h6>

                        <div class="row mb-3">
                            @foreach ($amenities as $amenity)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="amenities[]"
                                            value="{{ $amenity->id }}" id="amenity{{ $amenity->id }}"
                                            {{ in_array($amenity->id, old('amenities', $camp->amenities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                            <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Image -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Gambar</h6>

                        @if ($camp->image)
                            <div class="mb-3">
                                <label class="form-label">Gambar Semasa</label>
                                <div>
                                    <img src="{{ asset('storage/' . $camp->image) }}" alt="{{ $camp->name }}"
                                        class="img-thumbnail" style="max-width: 300px;">
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Baru (Optional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimum 2MB. Format: JPG, PNG</small>
                        </div>

                        <!-- Status -->
                        <h6 class="border-bottom pb-2 mb-3 mt-4">Status</h6>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="pending"
                                        {{ old('status', $camp->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved"
                                        {{ old('status', $camp->status) == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="rejected"
                                        {{ old('status', $camp->status) == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="is_featured" class="form-label">Featured</label>
                                <div class="form-check form-switch pt-2">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                        value="1" {{ old('is_featured', $camp->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Tampilkan sebagai featured camp
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.camps.index') }}" class="btn btn-outline-secondary btn-lg">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">Maklumat Tapak</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>ID:</th>
                            <td>{{ $camp->id }}</td>
                        </tr>
                        <tr>
                            <th>Dicipta:</th>
                            <td>{{ $camp->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dikemaskini:</th>
                            <td>{{ $camp->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Tontonan:</th>
                            <td>{{ number_format($camp->views_count) }}</td>
                        </tr>
                        <tr>
                            <th>Pencipta:</th>
                            <td>
                                @if ($camp->creator)
                                    {{ $camp->creator->name }}<br>
                                    <small class="text-muted">{{ $camp->creator->email }}</small>
                                @else
                                    <em>N/A</em>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Tindakan Pantas</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('camps.show', $camp) }}" target="_blank" class="btn btn-info w-100 mb-2">
                        <i class="fas fa-eye"></i> Lihat di Frontend
                    </a>

                    <form action="{{ route('admin.camps.destroy', $camp) }}" method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger w-100" id="deleteBtn">
                            <i class="fas fa-trash"></i> Padam Tapak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('deleteBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Adakah anda pasti?',
                text: 'Anda akan memadam tapak "{{ $camp->name }}". Tindakan ini tidak boleh dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Padam!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    </script>
@endpush
