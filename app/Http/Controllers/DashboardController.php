<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userId = $user->id;

        // Status data
        $statusCounts = Complaint::select('status', \DB::raw('count(*) as total'))
            ->where('user_id', $userId)
            ->groupBy('status')
            ->pluck('total', 'status');

        // Complaint Type data
        $typeCounts = \DB::table('complaints')
            ->join('complaint_types', 'complaints.type_id', '=', 'complaint_types.id')
            ->select('complaint_types.name', \DB::raw('count(*) as total'))
            ->where('complaints.user_id', $userId)
            ->groupBy('complaint_types.name')
            ->pluck('total', 'name');

        $totalComplaints = Complaint::where('user_id', $userId)->count();
        $resolvedCount = Complaint::where('user_id', $userId)->where('status', 'resolved')->count();
        $pendingCount = Complaint::where('user_id', $userId)->where('status', 'pending')->count();

        // Total complaint count
        $totalComplaintsAdmin = Complaint::count();

        // Status-wise complaint count (for Pie/Donut or Bar)
        $statusCountsAdmin = Complaint::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Type-wise complaint count (Bar/Pie)
        $typeCountsAdmin = \DB::table('complaints')
            ->join('complaint_types', 'complaints.type_id', '=', 'complaint_types.id')
            ->select('complaint_types.name', \DB::raw('count(*) as total'))
            ->groupBy('complaint_types.name')
            ->pluck('total', 'name');

        if ($user->role === "user") {
            return view('frontend.pages.index', compact('statusCounts', 'typeCounts', 'totalComplaints', 'resolvedCount', 'pendingCount'));
        } else {
            return view("admin.index", compact("totalComplaintsAdmin", "statusCountsAdmin", "typeCountsAdmin"));
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.pages.profile', compact('user'));
    }

    public function adminDashboard()
    {
        // Total complaint count
        $totalComplaintsAdmin = Complaint::count();

        // Status-wise complaint count (for Pie/Donut or Bar)
        $statusCountsAdmin = Complaint::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Type-wise complaint count (Bar/Pie)
        $typeCountsAdmin = \DB::table('complaints')
            ->join('complaint_types', 'complaints.type_id', '=', 'complaint_types.id')
            ->select('complaint_types.name', \DB::raw('count(*) as total'))
            ->groupBy('complaint_types.name')
            ->pluck('total', 'name');

        return view("admin.index", compact("totalComplaintsAdmin", "statusCountsAdmin", "typeCountsAdmin"));
    }
}
