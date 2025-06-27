@extends('layouts.admin')
@section('content')

<div class="container-fluid">
    <div class="row g-3 mb-4 justify-content-center">
        
        <!-- Total Vehicles Today -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <span class="icon-outline text-primary mb-2">
                        <i class="fas fa-sign-in-alt"></i>
                    </span>
                    <div class="mt-2 text-xs fw-bold text-primary text-uppercase mb-1 stat-title">
                        <b>Total vehicles Entered Today</b>
                    </div>
                    <div class="fs-4 fw-bold text-dark stat-value"><b>{{ $totalCount }}</b></div>
                </div>
            </div>
        </div>
        <!-- Vehicles Exited Today -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <span class="icon-outline text-warning mb-2">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <div class="mt-2 text-xs fw-bold text-warning text-uppercase mb-1 stat-title">
                        <b>Total Vehicles Exited Today</b>
                    </div>
                    <div class="fs-4 fw-bold text-dark stat-value"><b>{{ $vehiclesOut }}</b></div>
                </div>
            </div>
        </div>
        <!-- Currently In Campus -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <span class="icon-outline text-success mb-2">
                        <i class="fas fa-parking"></i>
                    </span>
                    <div class="mt-2 text-xs fw-bold text-success text-uppercase mb-1 stat-title">
                        <b>Overall Vehicles Currently In Campus</b>
                    </div>
                    <div class="fs-4 fw-bold text-dark stat-value"><b>{{ $currentInCampus }}</b></div>
                </div>
            </div>
        </div>
        <!-- Flagged Vehicles Today -->
        <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <span class="icon-outline text-danger mb-2">
                        <i class="fas fa-flag"></i>
                    </span>
                    <div class="mt-2 text-xs fw-bold text-danger text-uppercase mb-1 stat-title">
                        <b>Flagged Vehicles Today</b>
                    </div>
                    <div class="fs-4 fw-bold text-dark stat-value"><b>{{ $flaggedCount }}</b></div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS: Pie + Bar (side by side) -->
    <div class="row mb-4">
        <!-- Pie Chart -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color:#3F1457">Total number of cars (hourly)</h6>
                </div>
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="height:400px; min-height:320px;">
                    <canvas id="pieChart" style="height:100% !important; width:100% !important; max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
       <!-- Bar Chart -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color:#3F1457">Bar chart (Entries & Exits)</h6>
                </div>
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="height:400px; min-height:320px;">
                    <canvas id="barChart" style="height:100% !important; width:100% !important; max-height: 350px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart: FULL WIDTH under both charts above -->
    <div class="row mb-4">
        <div class="col-12 mb-4">
            <div class="card shadow h-100" style="width:100%;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold" style="color:#3F1457">Vehicle Trend (Today) - Entries & Exits</h6>
                </div>
                <div class="card-body p-3 d-flex align-items-center justify-content-center" style="height:400px; min-height:320px; width:100%;">
                    <canvas id="areaChart" style="height:100% !important; width:100% !important;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-title {
    font-size: 14px;
    font-weight: 400;
    text-align: center;
    letter-spacing: .02em;
    line-height: 1.2;
    min-height: 48px; /* force all titles to same height */
    display: flex;
    align-items: center;
    justify-content: center;
}

    .dashboard-card {
        box-shadow: 0 8px 24px rgba(8, 79, 160, 0.3);
        border-radius: 24px;
        background: #fff;
    }
    .wow-card {
        border-radius: 18px;
        transition: box-shadow 0.3s;
        box-shadow: 0 4px 24px rgba(3, 62, 129, 0.08), 0 1.5px 6px rgba(23,90,211,.06);
    }
    .wow-card:hover {
        box-shadow: 0 8px 36px rgba(80, 97, 198, 0.15), 0 3px 10px rgba(33, 37, 41, .08);
    }
    .icon-outline {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2.5px solid #15c0d5;
        font-size: 1.6rem;
        margin-bottom: 5px;
    }
    .icon-outline.text-info { border-color: #15c0d5; color: #15c0d5;}
    .icon-outline.text-primary { border-color: #175ad3; color: #175ad3;}
    .icon-outline.text-danger { border-color: #ed3c50; color: #ed3c50;}
    .icon-outline.text-success { border-color: #36d399; color: #36d399;}
    .icon-outline.text-purple { border-color: #8322ae; color: #8322ae;}
    .icon-outline.text-warning { border-color: #f6c957; color: #f6c957;}
    .text-purple { color: #8322ae !important; }
</style>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // PIE CHART
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
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right' },
                title: { display: true, text: 'Vehicle Count Per Hour (Today)' }
            }
        }
    });

    // BAR CHART: Entries & Exits (side by side)
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($barChartData['labels']) !!},
            datasets: {!! json_encode($barChartData['datasets']) !!}
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Number of Vehicles' }
                },
                x: {
                    title: { display: true, text: 'Hour' }
                }
            },
            plugins: {
                legend: { display: true }
            }
        }
    });

    // AREA CHART: Entries & Exits (as filled lines)
    const areaCtx = document.getElementById('areaChart').getContext('2d');
    const areaChart = new Chart(areaCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($barChartData['labels']) !!},
            datasets: [
                {
                    label: 'Entries',
                    data: {!! json_encode($barChartData['datasets'][0]['data']) !!},
                    backgroundColor: 'rgba(49, 150, 212, 0.2)',
                    borderColor: '#4F8DFD',
                    fill: true,
                    tension: 0.35
                },
                {
                    label: 'Exits',
                    data: {!! json_encode($barChartData['datasets'][1]['data']) !!},
                    backgroundColor: 'rgba(254, 157, 176, 0.84)',
                    borderColor: '#fe9db0',
                    fill: true,
                    tension: 0.35
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true }
            },
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
