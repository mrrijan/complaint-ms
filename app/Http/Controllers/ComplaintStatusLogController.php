<?php

namespace App\Http\Controllers;

use App\Models\ComplaintStatusLog;
use Illuminate\Http\Request;
use App\Exports\ComplaintStatusLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class ComplaintStatusLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaintStatuses = ComplaintStatusLog::with(["complaint", "changedBy"])->latest()->paginate(7);
        return view("admin.complaint_status_log", compact("complaintStatuses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function exportLogs()
    {
        return Excel::download(new ComplaintStatusLogsExport, 'complaint_status_logs.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintStatusLog $complaintStatusLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintStatusLog $complaintStatusLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintStatusLog $complaintStatusLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintStatusLog $complaintStatusLog)
    {
        //
    }
}
