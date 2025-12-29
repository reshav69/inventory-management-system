@extends('includes.layout')

@section('content')
@if(Auth::user()->role==='admin')
<h1>Admin Dashboard</h1>
@else
<h1>Staff Dashboard</h1>

@endif
<p>
    ALL CHARTS ARE FAKE DATA
</p>
<div>
    <div class="card" id="userChart">NOT THIS</div>
    @include('dashboard.widgets.salesovertime',['salesTrend'=>$salesTrend])
    <div class="card" id="salesOverTime"></div>
</div>
@endsection

{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var userChartOptions = {
            chart: {
                height: 350,
                type: 'pie',
            },
            series: [{{ $adminCount }}, {{ $staffCount }}],
            labels: ['Admin', 'Staff'],
            title: {
                text: 'User Role Distribution',
                align: 'center'
            }
        };

        var userChart = new ApexCharts(document.querySelector("#userChart"), userChartOptions);
        userChart.render();

        var totalSalesChartOptions = {
            chart: {
                height: 350,
                type: 'line',
            },
            series: [{
                name: 'Total Sales',
                data: [1000, 2000, 3000, 5000, 7000]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            },
            title: {
                text: 'Sales Over Time',
                align: 'center'
            }
        };
        var totalSales = new ApexCharts(document.querySelector("#totalSales"), totalSalesChartOptions);
        totalSales.render();

    });
</script>
 --}}