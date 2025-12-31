<div class="card">
    <div class="card-header">Top Products</div>
    <div class="card-body">
        <div id="topProductsChart"></div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const productNames = @json($topProducts->pluck('product.name'));
        const productTotals = @json($topProducts->pluck('total_sold'));

        var options = {
            series: [{
                name: 'Units Sold',
                data: productTotals
            }],
            chart: {
                type: 'bar',
                height: 300,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true, 
                }
            },
            xaxis: {
                categories: productNames,
            },
            colors: ['#3b82f6'], 
        };

        var chart = new ApexCharts(document.querySelector("#topProductsChart"), options);
        chart.render();
    });
</script>
@endpush