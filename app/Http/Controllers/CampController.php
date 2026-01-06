<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use App\Models\Amenity;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function index(Request $request)
    {
        $query = Camp::approved()->with(['amenities', 'creator']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('name_bm', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Filter by state
        if ($request->has('state') && $request->state) {
            $query->byState($request->state);
        }

        // Filter by amenities
        if ($request->has('amenities') && is_array($request->amenities)) {
            foreach ($request->amenities as $amenityId) {
                $query->whereHas('amenities', function($q) use ($amenityId) {
                    $q->where('amenities.id', $amenityId);
                });
            }
        }

        // Sort
        $sort = $request->get('sort', 'name');
        if ($sort === 'popular') {
            $query->orderBy('views_count', 'desc');
        } elseif ($sort === 'newest') {
            $query->latest();
        } else {
            $query->orderBy('name');
        }

        $camps = $query->paginate(12);
        $amenities = Amenity::active()->get();
        $states = $this->getMalaysianStates();

        return view('camps.index', compact('camps', 'amenities', 'states'));
    }

    public function show($id)
    {
        $camp = Camp::approved()
            ->with(['amenities', 'creator', 'activities' => function($query) {
                $query->active()->upcoming()->orderBy('start_date');
            }])
            ->findOrFail($id);

        // Increment view count
        $camp->incrementViews();

        return view('camps.show', compact('camp'));
    }

    public function map(Request $request)
    {
        $query = Camp::approved();

        if ($request->has('state') && $request->state) {
            $query->byState($request->state);
        }

        $camps = $query->get(['id', 'name', 'latitude', 'longitude', 'state', 'image']);
        $states = $this->getMalaysianStates();

        return view('camps.map', compact('camps', 'states'));
    }

    private function getMalaysianStates()
    {
        return [
            'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
            'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah',
            'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur',
            'Labuan', 'Putrajaya'
        ];
    }
}