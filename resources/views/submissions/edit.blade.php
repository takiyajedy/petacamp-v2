@extends('layouts.app')

@section('title', 'Cadang Perubahan - ' . $camp->name)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-edit"></i> Cadang Perubahan
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Info Alert -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Nota:</strong> Cadangan perubahan anda akan disemak oleh admin sebelum diluluskan.
                        </div>

                        <!-- Current Camp Info -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h6 class="text-muted mb-2">Tapak: <strong>{{ $camp->name }}</strong></h6>
                            @if($camp->image)
                                <img src="{{ asset('storage/' . $camp->image) }}" 
                                     alt="{{ $camp->name }}" 
                                     class="img-thumbnail"
                                     style="max-width: 200px;">
                            @endif
                        </div>

                        <form action="{{ route('camps.update', $camp) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <!-- Basic Information -->
                            <h5 class="border-bottom pb-2 mb-3">Maklumat Asas</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama (English) <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $camp->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="name_bm" class="form-label">Nama (Bahasa Melayu)</label>
                                    <input type="text" 
                                           class="form-control @error('name_bm') is-invalid @enderror" 
                                           id="name_bm" 
                                           name="name_bm" 
                                           value="{{ old('name_bm', $camp->name_bm) }}">
                                    @error('name_bm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Lokasi</h5>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Penuh <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3" 
                                          required>{{ old('address', $camp->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">Negeri <span class="text-danger">*</span></label>
                                    <select class="form-select @error('state') is-invalid @enderror" 
                                            id="state" 
                                            name="state" 
                                            required>
                                        <option value="">Pilih Negeri</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state }}" {{ old('state', $camp->state) == $state ? 'selected' : '' }}>
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
                                    <input type="text" 
                                           class="form-control @error('city') is-invalid @enderror" 
                                           id="city" 
                                           name="city" 
                                           value="{{ old('city', $camp->city) }}">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="postcode" class="form-label">Poskod</label>
                                    <input type="text" 
                                           class="form-control @error('postcode') is-invalid @enderror" 
                                           id="postcode" 
                                           name="postcode" 
                                           value="{{ old('postcode', $camp->postcode) }}">
                                    @error('postcode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="latitude" class="form-label">
                                        Latitude <span class="text-danger">*</span>
                                        <small class="text-muted">(cth: 3.1390)</small>
                                    </label>
                                    <input type="number" 
                                           step="0.00000001" 
                                           class="form-control @error('latitude') is-invalid @enderror" 
                                           id="latitude" 
                                           name="latitude" 
                                           value="{{ old('latitude', $camp->latitude) }}" 
                                           required>
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="longitude" class="form-label">
                                        Longitude <span class="text-danger">*</span>
                                        <small class="text-muted">(cth: 101.6869)</small>
                                    </label>
                                    <input type="number" 
                                           step="0.00000001" 
                                           class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" 
                                           name="longitude" 
                                           value="{{ old('longitude', $camp->longitude) }}" 
                                           required>
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-secondary small">
                                <i class="fas fa-lightbulb"></i> 
                                <strong>Tip:</strong> Gunakan <a href="https://www.google.com/maps" target="_blank">Google Maps</a> 
                                untuk dapatkan koordinat yang tepat. Klik kanan pada lokasi → pilih koordinat.
                            </div>

                            <!-- Descriptions -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Penerangan</h5>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Penerangan (English)</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4" 
                                          placeholder="Terangkan tentang tapak ini...">{{ old('description', $camp->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description_bm" class="form-label">Penerangan (Bahasa Melayu)</label>
                                <textarea class="form-control @error('description_bm') is-invalid @enderror" 
                                          id="description_bm" 
                                          name="description_bm" 
                                          rows="4" 
                                          placeholder="Terangkan tentang tapak ini...">{{ old('description_bm', $camp->description_bm) }}</textarea>
                                @error('description_bm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Maklumat Perhubungan</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone"></i> Nombor Telefon
                                    </label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $camp->phone) }}"
                                           placeholder="012-3456789">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope"></i> Email
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $camp->email) }}"
                                           placeholder="email@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="website" class="form-label">
                                        <i class="fas fa-globe"></i> Website
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('website') is-invalid @enderror" 
                                           id="website" 
                                           name="website" 
                                           value="{{ old('website', $camp->website) }}"
                                           placeholder="https://...">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing & Capacity -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Harga & Kapasiti</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="price_per_night" class="form-label">Harga/Malam (RM)</label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('price_per_night') is-invalid @enderror" 
                                           id="price_per_night" 
                                           name="price_per_night" 
                                           value="{{ old('price_per_night', $camp->price_per_night) }}"
                                           placeholder="0.00">
                                    @error('price_per_night')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="price_per_person" class="form-label">Harga/Orang (RM)</label>
                                    <input type="number" 
                                           step="0.01" 
                                           class="form-control @error('price_per_person') is-invalid @enderror" 
                                           id="price_per_person" 
                                           name="price_per_person" 
                                           value="{{ old('price_per_person', $camp->price_per_person) }}"
                                           placeholder="0.00">
                                    @error('price_per_person')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="max_capacity" class="form-label">Kapasiti Maksimum</label>
                                    <input type="number" 
                                           class="form-control @error('max_capacity') is-invalid @enderror" 
                                           id="max_capacity" 
                                           name="max_capacity" 
                                           value="{{ old('max_capacity', $camp->max_capacity) }}"
                                           placeholder="50">
                                    @error('max_capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="tent_sites" class="form-label">Tapak Khemah</label>
                                    <input type="number" 
                                           class="form-control @error('tent_sites') is-invalid @enderror" 
                                           id="tent_sites" 
                                           name="tent_sites" 
                                           value="{{ old('tent_sites', $camp->tent_sites) }}"
                                           placeholder="20">
                                    @error('tent_sites')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Amenities -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Kemudahan</h5>
                            
                            <div class="row mb-3">
                                @foreach($amenities as $amenity)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="amenities[]" 
                                                   value="{{ $amenity->id }}" 
                                                   id="amenity{{ $amenity->id }}"
                                                   {{ in_array($amenity->id, old('amenities', $camp->amenities->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="amenity{{ $amenity->id }}">
                                                <i class="fas {{ $amenity->icon }}"></i> {{ $amenity->label_bm }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Image Upload -->
                            <h5 class="border-bottom pb-2 mb-3 mt-4">Gambar</h5>
                            
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Gambar Baru (Optional)</label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maksimum 2MB. Format: JPG, PNG, GIF</small>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane"></i> Hantar Cadangan
                                </button>
                                <a href="{{ route('camps.show', $camp) }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection