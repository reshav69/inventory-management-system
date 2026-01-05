    <div class="card">
        <div class="card-header">Warehouse distribution</div>
        <div class="card-body">
            <div id="warehouseDistChart"></div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#warehouseDistChart"), {
                series: [{ 
                    name: 'Stock Level', 
                    data: @json($whTotals) 
                }],
                chart: { type: 'bar', height: 350, toolbar: { show: false } },
                plotOptions: { 
                    bar: { horizontal: true, borderRadius: 4 } 
                },
            colors: ['#6366f1'],
            xaxis: { 
                categories: @json($whNames) 
            },
        }).render();
        });
    </script>
    @endpush