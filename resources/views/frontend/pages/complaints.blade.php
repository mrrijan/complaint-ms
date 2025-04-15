@extends('frontend.pages.app')

@section('title', 'Complaint')

@section('content')
    <div class="col-lg-12 m-auto">
        <div class="card">
            <div class="d-flex justify-content-between card-header border-0">
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#complaintModal">
                    Add Complaint
                </button>

                <div class="w-50">
                    <input type="text" class="form-control" id="complaintSearch" placeholder="Search complaints...">
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-valign-middle" id="complaintTable">
                    <thead>
                    <tr>
                        <th>{{__('SN')}}</th>
                        <th>{{__("Title")}}</th>
                        <th>{{__("Description")}}</th>
                        <th>{{__('Location')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complaints as $complaint)
                        @php
                            $count = (string)$loop->iteration;
                        @endphp
                        <tr>
                            <td>{{__($count)}}</td>
                            <td>{{$complaint->title}}</td>
                            <td>{{$complaint->description }}</td>
                            <td>{{$complaint->location}}</td>
                            <td>
                                <span
                                                class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : ($complaint->status == 'in_progress' ? 'primary' : ($complaint->status == 'rejected' ? 'danger' : 'warning')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </span>
                            </td>
                            <td>
                                <form class="d-inline" action="{{url("complaint/view/$complaint->id")}}" method="GET">
                                    <button class="btn" data-toggle="tooltip" data-placement="bottom"
                                            title="{{__('View')}}">
                                        <i class="fa-solid fa-eye" style="color: #007bff"></i>
                                    </button>
                                </form>
                                @if($complaint->status === 'pending')
                                    {{-- Edit --}}
                                    <button
                                        class="btn btn-sm btn-edit"
                                        data-id="{{ $complaint->id }}"
                                        data-title="{{ $complaint->title }}"
                                        data-description="{{ $complaint->description }}"
                                        data-location="{{ $complaint->location }}"
                                        data-type="{{ $complaint->type_id }}"
                                        data-image="{{ $complaint->image_path }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editComplaintModal"
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pen text-warning"></i>
                                    </button>

                                    {{-- Delete --}}
                                    <form class="d-inline" action="{{ url("complaint/delete/$complaint->id") }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this complaint?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm" data-bs-toggle="tooltip" title="Delete">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-start">
                    {{ $complaints->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Complaint Modal -->
    <div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url("complaint/store") }}" method="POST" enctype="multipart/form-data"
                  class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="complaintModalLabel">New Complaint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Complaint Type</label>
                        <select class="form-select" name="type_id" id="type_id" required>
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image_path" class="form-label">Upload Image (optional)</label>
                        <input type="file" name="image_path" id="image_path" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Complaint</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Complaint Modal -->
    <div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" class="modal-content" enctype="multipart/form-data" id="editComplaintForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editComplaintModalLabel">Edit Complaint</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="complaint_id" id="editComplaintId">

                    <div class="mb-3">
                        <label for="edit_type_id" class="form-label">Complaint Type</label>
                        <select class="form-select" name="type_id" id="edit_type_id" required>
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_location" class="form-label">Location</label>
                        <input type="text" name="location" id="edit_location" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image_path" class="form-label">Current Image</label>
                        <div>
                            <img id="edit_preview_image" src="" class="img-fluid mb-2" style="max-height: 150px;" alt="No Image">
                        </div>
                        <input type="file" name="image_path" id="image_path" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Complaint</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.getElementById("complaintSearch").addEventListener("keyup", function () {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#complaintTable tbody tr");

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });

        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const title = button.dataset.title;
                const description = button.dataset.description;
                const location = button.dataset.location;
                const type = button.dataset.type;
                const imagePath = button.dataset.image;

                document.getElementById('editComplaintId').value = id;
                document.getElementById('edit_title').value = title;
                document.getElementById('edit_description').value = description;
                document.getElementById('edit_location').value = location;
                document.getElementById('edit_type_id').value = type;

                const previewImage = document.getElementById('edit_preview_image');
                if (imagePath) {
                    previewImage.src = `{{ asset('storage/') }}/` + imagePath;
                } else {
                    previewImage.src = '';
                }

                // Set form action
                document.getElementById('editComplaintForm').action = `/complaint/update/${id}`;
            });
        });
    </script>
@endpush
