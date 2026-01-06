@extends('layouts.app')

@section('title', 'Tambah Tapak Baru')

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="mb-4">Tambah Tapak Perkhemahan Baru</h1>
        
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> 
            Penyerahan anda akan disemak oleh admin sebelum diluluskan.
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('submissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Information -->
                    <h4 class="mb-3">Maklumat Asas</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Tapak (Bahasa Inggeris) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="name_bm" class="form-label">Nama Tapak (Bahasa Melayu)</label>
                            <input type="text" class="form-control @error('name_bm') is-invalid @enderror" 
                                   id="name_bm" name="name_bm" value="{{ old('name_bm') }}">
                            @error('name_bm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <h4 class="mb-3 mt-4">Lokasi</h4>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Penuh <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="state" class="form-label">Negeri <span class="text-danger">*</span></label>
                            <select class="form-select @error('state') is-invalid @enderror" 
                                    id="state" name="state" required>
                                <option value="">Pilih Negeri</option>
                                @foreach($states as $state)
                                    <option value="{{ $state }}" {{ old('state') == $state ? 'selected' : '' }}>
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
                                   id="city" name="city" value="{{ old('city') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="postcode" class="form-label">Poskod</label>
                            <input type="text" class="form-control @error('postcode') is-invalid @enderror" 
                                   id="postcode" name="postcode" value="{{ old('postcode') }}">
                            @error('postcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="latitude" class="form-label">Latitud <span class="text-danger">*</span></label>
                            <input type="number" step="0.00000001" class="form-control @error('latitude') is-invalid @enderror" 
                                   id="latitude" name="latitude" value="{{ old('latitude') }}" required>
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Contoh: 3.1390</small>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="longitude" class="form-label">Longitud <span class="text-danger">*</span></label>
                            <input type="number" step="0.00000001" class="form-control @error('longitude') is-invalid @enderror" 
                                   id="longitude" name="longitude" value="{{ old('longitude') }}" required>
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Contoh: 101.6869</small>
                        </div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-map-marker-alt"></i> 
                        Gunakan <a href="https://www.google.com/maps" target="_blank">Google Maps</a> untuk dapatkan koordinat yang tepat.
                        Klik kanan pada lokasi dan pilih koordinat.
                    </div>

                    <!-- Description -->
                    <h4 class="mb-3 mt-4">Penerangan</h4>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Penerangan (Bahasa Inggeris)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_bm" class="form-label">Penerangan (Bahasa Melayu)</label>
                        <textarea class="form-control @error('description_bm') is-invalid @enderror" 
                                  id="description_bm" name="description_bm" rows="4">{{ old('description_bm') }}</textarea>
                        @error('description_bm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contact Information -->
                    <h4 class="mb-3 mt-4">Maklumat Perhubungan</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="phone" class="form-label">Telefon</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="website" class="form-label">Laman Web</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                   id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Pricing -->
                    <h4 class="mb-3 mt-4">Harga</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price_per_night" class="form-label">Harga Per Malam (RM)</label>
                            <input type="number" step="0.01" class="form-control @error('price_per_night') is-invalid @enderror" 
                                   id="price_per_night" name="price_per_night" value="{{ old('price_per_night') }}">
                            @error('price_per_night')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="price_per_person" class="form-label">Harga Per Orang (RM)</label>
                            <input type="number" step="0.01" class="form-control @error('price_per_person') is-invalid @enderror" 
                                   id="price_per_person" name="price_per_person" value="{{ old('price_per_person') }}">
                            @error('price_per_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Capacity -->
                    <h4 class="mb-3 mt-4">Kapasiti</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="max_capacity" class="form-label">Kapasiti Maksimum (orang)</label>
                            <input type="number" class="form-control @error('max_capacity') is-invalid @enderror" 
                                   id="max_capacity" name="max_capacity" value="{{ old('max_capacity') }}">
                            @error('max_capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tent_sites" class="form-label">Bilangan Tapak Khemah</label>
                            <input type="number" class="form-control @error('tent_sites') is-invalid @enderror" 
                                   id="tent_sites" name="tent_sites" value="{{ old('tent_sites') }}">
                            @error('tent_sites')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Amenities -->
                    <h4 class="mb-3 mt-4">Kemudahan</h4>
                    
                    <div class="row mb-3">
                        @foreach($amenities as $amenity)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="amenities[]" 
                                           value="{{ $amenity->id }}" id="amenity{{ $amenity->id }}"
                                           {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                        <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Image Upload -->
                    <h4 class="mb-3 mt-4">Gambar</h4>
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Utama</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Maksimum 2MB. Format: JPG, PNG</small>
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i> Hantar Penyerahan
                        </button>
                        <a href="{{ route('camps.index') }}" class="btn btn-outline-secondary btn-lg">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection