<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\Camp;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{

    public function index(Request $request)
    {
        $query = Submission::with(['submitter', 'camp', 'reviewer']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $submissions = $query->latest('submitted_at')->paginate(20);

        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(Submission $submission)
    {
        $submission->load(['submitter', 'camp', 'reviewer']);
        return view('admin.submissions.show', compact('submission'));
    }

    public function approve(Submission $submission)
    {
        DB::beginTransaction();
        try {
            if ($submission->type === 'new_camp') {
                // Create new camp
                $camp = Camp::create(array_merge(
                    $submission->data,
                    [
                        'status' => 'approved',
                        'created_by' => $submission->submitted_by,
                    ]
                ));

                // Attach amenities if exists
                if (isset($submission->data['amenities'])) {
                    $camp->amenities()->attach($submission->data['amenities']);
                }

            } elseif ($submission->type === 'edit_camp') {
                // Update existing camp
                $camp = Camp::findOrFail($submission->camp_id);
                $camp->update($submission->data);

                // Update amenities if exists
                if (isset($submission->data['amenities'])) {
                    $camp->amenities()->sync($submission->data['amenities']);
                }
            }

            // Update submission
            $submission->update([
                'status' => 'approved',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now(),
            ]);

            // Log audit
            AuditLog::create([
                'actor_id' => Auth::id(),
                'action' => 'submission.approved',
                'entity_type' => 'Submission',
                'entity_id' => $submission->id,
                'after' => $submission->toArray(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            DB::commit();

            return redirect()
                ->route('admin.submissions.index')
                ->with('success', 'Penyerahan telah diluluskan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ralat: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $submission->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        // Log audit
        AuditLog::create([
            'actor_id' => Auth::id(),
            'action' => 'submission.rejected',
            'entity_type' => 'Submission',
            'entity_id' => $submission->id,
            'after' => $submission->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('admin.submissions.index')
            ->with('success', 'Penyerahan telah ditolak.');
    }
}