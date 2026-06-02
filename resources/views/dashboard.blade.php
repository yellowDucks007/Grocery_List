@extends('layouts.app')

@section('title', 'Dashboard – GroCart')
@section('page-title', 'Dashboard')

@section('styles')
<style>
    /*  STAT CARDS  */
    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        border: 1px solid rgba(16,55,64,0.07);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .ic-forest     { background-color: rgba(16,55,64,0.1); }
    .ic-fern       { background-color: rgba(60,89,62,0.12); }
    .ic-gold       { background-color: rgba(217,164,67,0.15); }
    .ic-terracotta { background-color: rgba(217,107,82,0.12); }

    .stat-label {
        font-size: 0.78rem;
        color: #6b7a6c;
        font-weight: 400;
        margin-bottom: 2px;
    }

    .stat-value {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.75rem;
        color: var(--forest);
        font-weight: 600;
        line-height: 1;
    }

    .stat-sub {
        font-size: 0.72rem;
        color: #9aaa9b;
        margin-top: 4px;
    }

    /*  CHART CARDS  */
    .chart-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid rgba(16,55,64,0.07);
        height: 100%;
    }

    .chart-card-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 1rem;
        color: var(--forest);
        font-weight: 800;
        margin-bottom: 0.2rem;
    }

    .chart-card-sub {
        font-size: 0.78rem;
        color: #6b7a6c;
        font-weight: 300;
        margin-bottom: 1.25rem;
    }

    .chart-container {
        position: relative;
        height: 250px;
    }

    .chart-container-sm {
        position: relative;
        height: 220px;
    }
    /*  RECENT CARDS  */
    .recent-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid rgba(16,55,64,0.07);
        height: 100%;
    }

    .recent-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid rgba(16,55,64,0.06);
    }

    .recent-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .item-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .dot-fern       { background-color: #3C593E; }
    .dot-gold       { background-color: #D9A443; }
    .dot-terracotta { background-color: #D96B52; }

    .item-name {
        font-size: 0.875rem;
        color: var(--forest);
        font-weight: 400;
        line-height: 1.2;
    }

    .item-meta {
        font-size: 0.75rem;
        color: #9aaa9b;
        margin-top: 1px;
    }

    .badge-done {
        margin-left: auto;
        font-size: 0.72rem;
        padding: 3px 10px;
        border-radius: 10px;
        background-color: rgba(60,89,62,0.12);
        color: #3C593E;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-pending {
        margin-left: auto;
        font-size: 0.72rem;
        padding: 3px 10px;
        border-radius: 10px;
        background-color: rgba(217,164,67,0.15);
        color: #a07820;
        font-weight: 500;
        white-space: nowrap;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: var(--cream);
        font-weight: 500;
        flex-shrink: 0;
        text-transform: uppercase;
    }
</style>
@endsection

@section('content')

<!-- ==================== STAT CARDS ==================== -->
<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon ic-forest">👥</div>
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-sub">Registered accounts</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon ic-fern">🛒</div>
            <div>
                <div class="stat-label">Grocery Items</div>
                <div class="stat-value">{{ $totalItems }}</div>
                <div class="stat-sub">All items in list</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon ic-gold">✅</div>
            <div>
                <div class="stat-label">Completed</div>
                <div class="stat-value">{{ $completedItems }}</div>
                <div class="stat-sub">Items purchased</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon ic-terracotta">⏳</div>
            <div>
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $pendingItems }}</div>
                <div class="stat-sub">Items remaining</div>
            </div>
        </div>
    </div>

</div>

<!-- ==================== CHARTS ROW ==================== -->
<div class="row g-3 mb-4">

    <!-- Bar Chart -->
    <div class="col-xl-7 col-md-12">
        <div class="chart-card">
            <div class="chart-card-title">Items Added Per Month</div>
            <div class="chart-card-sub">Monthly grocery list activity</div>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="col-xl-5 col-md-12">
        <div class="chart-card">
            <div class="chart-card-title">Items by Category</div>
            <div class="chart-card-sub">Distribution across categories</div>
            <div class="chart-container-sm">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- ==================== RECENT ROWS ==================== -->
<div class="row g-3">

    <!-- Recent Grocery Items -->
    <div class="col-md-6">
        <div class="recent-card">
            <div class="chart-card-title">Recent Grocery Items</div>
            <div class="chart-card-sub">Latest entries in your list</div>

            @forelse ($recentItems as $item)
                <div class="recent-item">
                    <div class="item-dot {{ $item->status === 'completed' ? 'dot-fern' : ($item->status === 'pending' ? 'dot-gold' : 'dot-terracotta') }}"></div>
                    <div>
                        <div class="item-name">{{ $item->name }}</div>
                        <div class="item-meta">{{ $item->category }}</div>
                    </div>
                    @if ($item->status === 'completed')
                        <span class="badge-done">Done</span>
                    @else
                        <span class="badge-pending">Pending</span>
                    @endif
                </div>
            @empty
                <p style="font-size:0.875rem; color:#9aaa9b; margin-top:1rem;">No grocery items yet.</p>
            @endforelse

        </div>
    </div>

    <!-- Recent Users -->
    <div class="col-md-6">
        <div class="recent-card">
            <div class="chart-card-title">Recent Users</div>
            <div class="chart-card-sub">Latest registered accounts</div>

            @forelse ($recentUsers as $user)
                <div class="recent-item">
                    <div class="user-avatar" style="background-color: {{ $loop->iteration % 2 === 0 ? '#103740' : '#3C593E' }};">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="item-name">{{ $user->name }}</div>
                        <div class="item-meta">{{ $user->email }}</div>
                    </div>
                </div>
            @empty
                <p style="font-size:0.875rem; color:#9aaa9b; margin-top:1rem;">No users yet.</p>
            @endforelse

        </div>
    </div>

</div>

@endsection

<!-- ==================== SCRIPTS ==================== -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    /* Bar Chart – Items Added Per Month */
    var barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($barLabels),
            datasets: [{
                label: 'Items Added',
                data:  @json($barData),
                backgroundColor: '#3C593E',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });

    /* Donut Chart – Items by Category */
    var donutCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: @json($donutLabels),
            datasets: [{
                data: @json($donutData),
                backgroundColor: ['#103740', '#3C593E', '#D9A443', '#D96B52', '#a0b8a2', '#c4d4c5'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 11, family: 'Poppins' },
                        padding: 14,
                    }
                }
            }
        }
    });
</script>
@endsection