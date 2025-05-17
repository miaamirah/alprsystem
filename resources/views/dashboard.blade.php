@extends('layouts.admin')
@section('content')

<div class="container-fluid">

    <!-- Row: Summary Cards -->
    <div class="row mb-4">
        <!-- Total Vehicles -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Vehicles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flagged Vehicles -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Flagged Vehicles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $flaggedCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row: Bar & Pie Charts -->
    <div class="row mb-4">
        <!-- Bar Chart -->
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body p-2">
                    <canvas id="barChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow h-100">
                <div class="card-body p-3">
                    <canvas id="pieChart" height="98"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Row: Area Chart -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow h-100">
                <div class="card-body p-3">
                    <canvas id="areaChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($hourlyCounts->keys()) !!}, // like ['08:00AM', '10:00AM']
                datasets: [{
                    data: {!! json_encode($hourlyCounts->values()) !!}, // like [5, 3]
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                        '#858796', '#20c9a6', '#9966ff', '#ff007f', '#ffcc00'
                    ]
                }]
            }
        });
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($barChartData['labels']) !!},
                datasets: {!! json_encode($barChartData['datasets']) !!}
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Vehicles'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hour'
                        }
                    }
                }
            }
        });
        const areaCtx = document.getElementById('areaChart').getContext('2d');
    const areaChart = new Chart(areaCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($barChartData['labels']) !!},
            datasets: [{
                label: 'Number of Vehicles',
                data: {!! json_encode($barChartData['datasets'][0]['data']) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // fill under the line
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Vehicles' }
                },
                x: {
                    title: { display: true, text: 'Hour' }
                }
            }
        }
    });
    </script>
    @endpush