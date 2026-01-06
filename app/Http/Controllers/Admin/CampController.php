<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\Amenity;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function index()
    {
        $camps = Camp::with(['creator', 'amenities'])
            ->latest()
            ->paginate(20);

        return view('admin.camps.index', compact('camps'));
    }

    public function show(Camp $camp)
    {
        $camp->load(['creator', 'amenities', 'activities']);
        return view('admin.camps.show', compact('camp'));
    }

    public function edit(Camp $camp)
    {
        $amenities = Amenity::active()->get();
        $states = $this->getStates();
        return view('admin.camps.edit', compact('camp', 'amenities', 'states'));
    }

    public function update(Request $request, Camp $camp)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:pending,approved,rejected',
            // Add other fields
        ]);

        $camp->update($validated);

        if ($request->has('amenities')) {
            $camp->amenities()->sync($request->amenities);
        }

        return redirect()->route('admin.camps.index')
            ->with('success', 'Camp updated successfully.');
    }

    public function destroy(Camp $camp)
    {
        $camp->delete();
        return redirect()->route('admin.camps.index')
            ->with('success', 'Camp deleted successfully.');
    }

    private function getStates()
    {
        return [
            'Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan',
            'Pahang', 'Penang', 'Perak', 'Perlis', 'Sabah',
            'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur',
            'Labuan', 'Putrajaya'
        ];
    }
}