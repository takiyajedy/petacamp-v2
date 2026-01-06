<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Camp;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{

    public function create()
    {
        $amenities = Amenity::active()->get();
        $states = $this->getMalaysianStates();
        
        return view('submissions.create', compact('amenities', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bm' => 'nullable|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string',
            'city' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'nullable|string',
            'description_bm' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'price_per_night' => 'nullable|numeric|min:0',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $validated;
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('submissions', 'public');
            }

            // Create submission
            $submission = Submission::create([
                'type' => 'new_camp',
                'submitted_by' => Auth::id(),
                'data' => $data,
                'status' => 'pending',
                'submitted_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('camps.index')
                ->with('success', 'Terima kasih! Penyerahan anda sedang menunggu semakan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Ralat berlaku. Sila cuba lagi.');
        }
    }

    public function edit(Camp $camp)
    {
        // Check if user is the creator or admin
        if ($camp->created_by !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $amenities = Amenity::active()->get();
        $states = $this->getMalaysianStates();
        
        return view('submissions.edit', compact('camp', 'amenities', 'states'));
    }

    public function update(Request $request, Camp $camp)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bm' => 'nullable|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string',
            'description' => 'nullable|string',
            'description_bm' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'price_per_night' => 'nullable|numeric|min:0',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'image' => 'nullable|image|max:2048',
            // ... other fields
        ]);

        $submission = Submission::create([
            'type' => 'edit_camp',
            'camp_id' => $camp->id,
            'submitted_by' => Auth::id(),
            'data' => $validated,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('camps.show', $camp)
            ->with('success', 'Cadangan perubahan telah dihantar.');
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