@extends('includes.layout')

@section('content')
<h1>Admin Dashboard</h1>
<p>
    ALL CHARTS ARE FAKE DATA
</p>
<div>
    <div class="card" id="userChart">NOT THIS</div>
    <div class="card" id="totalSales"></div>

</div>
@endsection


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
