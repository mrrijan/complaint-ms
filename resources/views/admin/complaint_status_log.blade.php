@extends('admin.app')

@section('title', 'Complaint')

@section('content')
    <div class="col-lg-12 m-auto">
        <div class="card">
              <div class="d-flex justify-content-between card-header border-0">
                <h4>Logs</h4>
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
                        <th>{{__("Changed By")}}</th>
                        <th>{{__('Old Status')}}</th>
                        <th>{{__('New Status')}}</th>
                        <th>{{__('Remarks')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complaintStatuses as $complaint)
                        @php
                            $count = (string)$loop->iteration;
                        @endphp
                        <tr>
                            <td>{{__($count)}}</td>
                            <td>{{$complaint->complaint->title}}</td>
                            <td>{{$complaint->changedBy->name }}</td>
                            <td>{{$complaint->old_status}}</td>
                            <td>{{$complaint->new_status}}</td>
                            <td>{{$complaint->remark}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-start">
                    {{ $complaintStatuses->links() }}
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
