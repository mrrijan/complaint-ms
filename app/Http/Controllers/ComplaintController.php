<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;
use App\Mail\ComplaintSubmittedMail;
use App\Models\Complaint;
use App\Models\ComplaintType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\ComplaintStatusLog;

class ComplaintController extends Controller
{
    /**R
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $complaints = Complaint::where('user_id', $user_id)->latest()->paginate(7);
        $types = ComplaintType::all();

        return view("frontend.pages.complaints", compact("complaints", "types"));
    }

    public function updateComplaint(Request $request)
    {
        $complaint = Complaint::where("id", $request->complaint_id)->first();

        // Log status change
        if ($complaint->status !== $request->status) {
            ComplaintStatusLog::create([
                'complaint_id' => $complaint->id,
                'changed_by' => Auth::user()->id,
                'old_status' => $complaint->status,
                'new_status' => $request->status,
                'remark' => $request->remark,
            ]);
        }

        $complaint->status = $request->status;
        $complaint->admin_remark = $request->remark;
        $complaint->save();

        return redirect("/admin/complaints");
    }
    public function getAdminComplaints()
    {
        $complaints = Complaint::latest()->paginate(7);
        $types = ComplaintType::all();
        return view("admin.complaints", compact("complaints", "types"));
    }
    // public function adminDashboard()
    // {
    //     return view("admin.app");
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintStoreRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName(); // optional: you can hash it too
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }


        $complaint = Complaint::create([
            "title" => $request->title,
            "description" => $request->description,
            "location" => $request->location,
            "type_id" => $request->type_id,
            "user_id" => Auth::user()->id,
            "image_path" => $imagePath,
        ]);

        Mail::to(Auth::user()->email)->send(new ComplaintSubmittedMail($complaint));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($complaint_id)
    {
        $complaint = Complaint::where('id', $complaint_id)->first();
        return view("frontend.pages.complaint", compact("complaint"));
    }

    public function viewComplaint($complaint_id)
    {
        $complaint = Complaint::where("id", $complaint_id)->first();
        return view("admin.complaint", compact("complaint"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintUpdateRequest $request, $complaint_id)
    {
        $complaint = Complaint::where("id", $complaint_id)->first();

        $imagePath = $complaint->image_path;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName(); // optional: you can hash it too
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        $complaint->title = $request->title;
        $complaint->description = $request->description;
        $complaint->location = $request->location;
        $complaint->type_id = $request->type_id;
        $complaint->image_path = $imagePath;
        $complaint->user_id = Auth::user()->id;
        $complaint->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($complaint_id)
    {
        $complaint = Complaint::where('id', $complaint_id)->first();
        $complaint->delete();

        return redirect()->back();
    }
}
