<div class="card">
    <div class="card-header">Stock Health</div>
    <div class="card-body">
        <div id="stockHealthChart"></div>
    </div>
</div>
@push('scripts')
<script>
	document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#stockHealthChart"), {
            series: @json(array_values($stockHealth)),
            labels: ['In Stock', 'Low Stock', 'Out of Stock'],
            chart: { type: 'donut', height: 350 },
            colors: ['#10b981', '#f59e0b', '#ef4444'],
            legend: { position: 'bottom' },
            plotOptions: { pie: { donut: { labels: { show: true } } } }
        }).render();
    });
</script>
@endpush