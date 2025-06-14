<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintTypeStoreRequest;
use App\Http\Requests\ComplaintTypeUpdateRequest;
use App\Models\Complaint;
use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaintTypes = ComplaintType::all();
        return view("admin.complaint_type", compact("complaintTypes"));
    }

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
    public function store(ComplaintTypeStoreRequest $request)
    {
        ComplaintType::create([
            "name" => $request->name
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintTypeUpdateRequest $request, $complaint_type_id)
    {
        $complaintType = ComplaintType::where("id", $complaint_type_id)->first();

        $complaintType->name = $request->name;
        $complaintType->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($complaint_type_id)
    {
        $complaintType = ComplaintType::where("id", $complaint_type_id)->first();
        $complaintType->delete();

        return redirect()->back();
    }
}
