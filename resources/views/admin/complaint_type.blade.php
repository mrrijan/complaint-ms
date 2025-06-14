@extends('admin.app')

@section('title', 'Manage Complaint Types')

@section('content')
<div class="col-lg-12 m-auto">
    <div class="card">
        <div class="d-flex justify-content-between card-header border-0">
            <h4>Complaint Types</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTypeModal">
                Add
            </button>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($complaintTypes as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <!-- Edit -->
                                <button class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTypeModal"
                                        data-id="{{ $type->id }}"
                                        data-name="{{ $type->name }}">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </button>

                                <!-- Delete -->
                                <form method="POST" action="{{ url('admin/complaint-type/delete/' . $type->id) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this type?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Type Modal -->
<div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ url('admin/complaint-types/store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add Complaint Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="type_name" class="form-label">Type Name</label>
                    <input type="text" name="name" id="type_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Type Modal -->
<div class="modal fade" id="editTypeModal" tabindex="-1" aria-labelledby="editTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" id="editTypeForm">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Complaint Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="type_id" id="edit_type_id">
                <div class="mb-3">
                    <label for="edit_type_name" class="form-label">Type Name</label>
                    <input type="text" name="name" id="edit_type_name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const editModal = document.getElementById('editTypeModal');
    editModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');

        document.getElementById('edit_type_id').value = id;
        document.getElementById('edit_type_name').value = name;
        document.getElementById('editTypeForm').action = `/admin/complaint-types/update/${id}`;
    });
</script>
@endpush
