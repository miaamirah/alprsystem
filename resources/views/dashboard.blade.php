@extends('layouts.admin')
@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <!-- Total This Week -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Vehicles This Week</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $weekCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Vehicles -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Vehicles Daily</div>
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

   <!-- Row: Pie & Bar Charts -->
    <div class="row mb-4">
        <!-- Pie Chart -->
        <div class="col-md-6">
            <div class="card shadow h-52">
                <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold"style="color:#3F1457">Total number of cars (hourly)</h6>
                </div>
                <div class="card-body p-3" style="height: 385px;">
                <canvas id="pieChart" style="height: 100% !important; width: 50% !important;"></canvas>
                </div>

            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-md-6">
            <div class="card shadow h-80">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color:#3F1457">Bar chart</h6>
                    </div>
                <div class="card-body p-2">
                    <canvas id="barChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

        <!-- Area Chart -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color:#3F1457">Vehicle Trend (Today)</h6>
                    </div>
                    <div class="card-body" style="height: 300px;">
                    <canvas id="areaChart" style="height: 100% !important; width: 100% !important;"></canvas>
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
                    labels: {!! json_encode($hourlyCounts->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($hourlyCounts->values()) !!},
                        backgroundColor: [
                            '#CDB4DB', '#ffc8dd', '#ffafcc', '#bde0fe', '#A2D2FF',
                            '#B9FBC0', '#98f5e1', '#8eecf5', '#A3C4F3', '#FFCFD2',
                            '#fde4cf', '#9bf6ff', '#caffbf', '#ffd6a5', '#ffadad',
                            '#d0f4de', '#a9def9', '#e4c1f9', '#fdffb6', '#caffbf',
                            '#9bf6ff', '#bdb2ff', '#ffc6ff', '#fffffc'
                        ],
                        
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right'
                        },
                        title: {
                            display: true,
                            text: 'Vehicle Count Per Hour (Today)'
                        }
                    }
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
                backgroundColor: '#BDB2FF', 
                borderColor: 'rgba(24, 32, 177, 0.57)',
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