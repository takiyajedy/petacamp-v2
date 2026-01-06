<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Models\Submission;
use App\Models\User;
use App\Models\Activity;

class DashboardController extends Controller
{

    public function index()
    {
        $stats = [
            'total_camps' => Camp::count(),
            'approved_camps' => Camp::where('status', 'approved')->count(),
            'pending_submissions' => Submission::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'total_activities' => Activity::count(),
        ];

        $recentSubmissions = Submission::with(['submitter', 'camp'])
            ->latest('submitted_at')
            ->limit(5)
            ->get();

        $recentCamps = Camp::with('creator')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions', 'recentCamps'));
    }
}