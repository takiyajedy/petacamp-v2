<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_bm',
        'description',
        'description_bm',
        'type',
        'schedule_json',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'camp_id',
        'created_by',
    ];

    protected $casts = [
        'schedule_json' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now()->toDateString());
    }
}