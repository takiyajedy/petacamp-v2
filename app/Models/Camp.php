<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'name_bm',
        'address',
        'state',
        'city',
        'postcode',
        'latitude',
        'longitude',
        'description',
        'description_bm',
        'phone',
        'email',
        'website',
        'operating_hours',
        'price_per_night',
        'price_per_person',
        'pricing_notes',
        'max_capacity',
        'tent_sites',
        'image',
        'gallery',
        'status',
        'created_by',
        'rejection_reason',
        'views_count',
        'is_featured',
    ];

    protected $casts = [
        'operating_hours' => 'array',
        'gallery' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'price_per_night' => 'decimal:2',
        'price_per_person' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'camp_amenities')
                    ->withPivot('notes')
                    ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByState($query, $state)
    {
        return $query->where('state', $state);
    }

    // Helpers
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}