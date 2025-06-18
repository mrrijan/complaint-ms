@extends('admin.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Total Complaints</h5>
                        <p class="fs-3">{{ $totalComplaintsAdmin }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Status Categories</h5>
                        <p class="fs-3">{{ count($statusCountsAdmin) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Complaint Types</h5>
                        <p class="fs-3">{{ count($typeCountsAdmin) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <canvas style="max-height: 300px;" id="adminStatusChart"></canvas>
            </div>
            <div class="col-md-6 mb-4">
                <canvas style="max-height: 300px;" id="adminTypeChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // PHP -> JS
        const adminStatusData = {!! json_encode($statusCountsAdmin) !!};
        const adminTypeData = {!! json_encode($typeCountsAdmin) !!};

        // Status Pie Chart
        new Chart(document.getElementById('adminStatusChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(adminStatusData),
                datasets: [{
                    label: 'Status Distribution',
                    data: Object.values(adminStatusData),
                }]
            }
        });

        // Type Doughnut Chart
        new Chart(document.getElementById('adminTypeChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(adminTypeData),
                datasets: [{
                    label: 'Type Distribution',
                    data: Object.values(adminTypeData),
                }]
            }
        });
    </script>
@endpush
