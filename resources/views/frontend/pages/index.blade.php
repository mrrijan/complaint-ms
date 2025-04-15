@extends('frontend.pages.app')

@section('title', 'Home')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Dashboard</h2>
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Total Complaints</h5>
                        <p class="fs-3">{{ $totalComplaints }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Resolved</h5>
                        <p class="fs-3">{{ $resolvedCount }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm card-hover">
                    <div class="card-body">
                        <h5>Pending</h5>
                        <p class="fs-3">{{ $pendingCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <canvas style="max-height: 300px;" id="statusChart"></canvas>
            </div>
            <div class="col-md-6 mb-4">
                <canvas style="max-height: 300px;" id="typeChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Convert PHP data to JS
        const statusData = {!! json_encode($statusCounts) !!};
        const typeData = {!! json_encode($typeCounts) !!};

        // Status Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(statusData),
                datasets: [{
                    label: 'Complaints by Status',
                    data: Object.values(statusData),
                }]
            }
        });

        // Type Chart
        new Chart(document.getElementById('typeChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(typeData),
                datasets: [{
                    label: 'Complaints by Type',
                    data: Object.values(typeData),
                }]
            }
        });


    </script>
@endpush
