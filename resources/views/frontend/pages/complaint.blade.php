@extends('frontend.pages.app')

@section('title', 'Complaint')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Complaint Details</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Title:</strong><br> {{ $complaint->title }}</p>
                <p><strong>Description:</strong><br> {{ $complaint->description }}</p>
                <p><strong>Location:</strong> {{ $complaint->location }}</p>

                <p>
                    <strong>Status:</strong>
                    <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : ($complaint->status == 'in_progress' ? 'primary' : ($complaint->status == 'rejected' ? 'danger' : 'warning')) }}">
                        {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                    </span>
                </p>

                <p><strong>Type:</strong> {{ $complaint->type->name ?? 'N/A' }}</p>

                @if($complaint->image_path)
                    <div class="mt-4">
                        <strong>Uploaded Image:</strong><br>
                        <img src="{{ asset('storage/' . $complaint->image_path) }}" alt="Complaint Image" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                @endif

                @if($complaint->admin_remark)
                    <div class="mt-4">
                        <strong>Admin Remark:</strong>
                        <div class="alert alert-info mt-2">
                            {{ $complaint->admin_remark }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
