@extends('layouts.main')

@section('content')
<section class="page-section dashboard-section">
    <div class="container">
        <h2 class="page-title mb-4">Dashboard</h2>
        
        {{-- Stats Cards --}}
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2>{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <h2>{{ $totalCustomers }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">My Customers</h5>
                        <h2>{{ $myCustomers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="row">
            <div class="col-md-12">
                <div class="page-card">
                    <h5 class="mb-3">Statistics Overview</h5>
                    <canvas id="dashboardChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('dashboardChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Users', 'Total Customers', 'My Customers'],
        datasets: [{
            label: 'Count',
            data: [{{ $totalUsers }}, {{ $totalCustomers }}, {{ $myCustomers }}],
            backgroundColor: [
                '#007bff',
                '#28a745',
                '#17a2b8'
            ],
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
@endsection