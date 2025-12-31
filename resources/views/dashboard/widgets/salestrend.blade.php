    <div class="card">
        <div class="card-header">Sales Trend</div>
        <div class="card-body">
            <div id="salesTrendChart"></div>
        </div>
    </div>

@push('scripts')
<script>
    (() => {
        const data = @json($salesTrend);

        new ApexCharts(
            document.querySelector("#salesTrendChart"),
            {
                chart: { type: 'area', height: 300, },
                series: [{
                    name: 'Sales',
                    data: data.map(d => d.total)
                }],
                xaxis: {
                    categories: data.map(d => d.sale_date)
                }
            }
        ).render();
    })();
</script>
@endpush
