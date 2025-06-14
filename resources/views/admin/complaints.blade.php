@extends('admin.app')

@section('title', 'Complaint')

@section('content')
    <div class="col-lg-12 m-auto">
        <div class="card">
              <div class="d-flex justify-content-between card-header border-0">
                <h4>Complaints</h4>
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
                                <form class="d-inline" action="{{url("/admin/complaint/change-status/$complaint->id")}}" method="GET">
                                    <button class="btn" data-toggle="tooltip" data-placement="bottom"
                                            title="{{__('View')}}">
                                        <i class="fa-solid fa-eye" style="color: #007bff"></i>
                                    </button>
                                </form>
                        
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

    </script>
@endpush
