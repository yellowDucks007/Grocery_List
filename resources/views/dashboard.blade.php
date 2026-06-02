@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    :root {
        --forest: #103740;
        --fern: #3C593E;
        --cream: #F2EAE4;
    }

    body {
        background: var(--cream);
    }

    .dashboard-title {
        font-family: 'Playfair Display', serif;
        color: var(--forest);
        font-weight: 600;
    }

    .card-metric {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(16,55,64,0.08);
        transition: 0.2s;
    }

    .card-metric:hover {
        transform: translateY(-2px);
    }

    .metric-icon {
        font-size: 1.5rem;
    }

    .chart-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(16,55,64,0.08);
    }
</style>

<div class="container-fluid">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="dashboard-title mb-1">
                Welcome back, {{ Auth::user()->name }} 👋
            </h3>
            <p class="text-muted mb-0">
                Here’s what’s happening with your FreshCart today.
            </p>
        </div>
    </div>

    <!-- METRICS -->
    <div class="row g-3 mb-4">

        <div class="col-md-6 col-lg-4">
            <div class="card card-metric p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Users</small>
                        <h3 class="mb-0">{{ $userCount ?? 0 }}</h3>
                    </div>
                    <div class="metric-icon">👥</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-metric p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Grocery Records</small>
                        <h3 class="mb-0">{{ $groceryCount ?? 0 }}</h3>
                    </div>
                    <div class="metric-icon">🛒</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="card card-metric p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Today</small>
                        <h3 class="mb-0">{{ now()->format('M d') }}</h3>
                    </div>
                    <div class="metric-icon">📅</div>
                </div>
            </div>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="row g-3">

        <!-- USERS CHART -->
        <div class="col-lg-6">
            <div class="card chart-card p-3">
                <h6 class="mb-3">Users Overview</h6>
                <canvas id="usersChart"></canvas>
            </div>
        </div>

        <!-- GROCERY CHART -->
        <div class="col-lg-6">
            <div class="card chart-card p-3">
                <h6 class="mb-3">Grocery Records Overview</h6>
                <canvas id="groceryChart"></canvas>
            </div>
        </div>

    </div>

</div>

<!-- CHART JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // USERS CHART
    new Chart(document.getElementById('usersChart'), {
        type: 'bar',
        data: {
            labels: ['Users'],
            datasets: [{
                label: 'Total Users',
                data: [{{ $userCount ?? 0 }}],
                backgroundColor: '#3C593E'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // GROCERY CHART
    new Chart(document.getElementById('groceryChart'), {
        type: 'bar',
        data: {
            labels: ['Grocery Records'],
            datasets: [{
                label: 'Total Records',
                data: [{{ $groceryCount ?? 0 }}],
                backgroundColor: '#D9A443'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

@endsection