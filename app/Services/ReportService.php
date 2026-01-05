<?php
namespace App\Services;

use App\Models\Sale;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Traits\HasNepaliDate;


class ReportService
{
    protected $todayDate;

    public function __construct()
    {
        $this->todayDate = HasNepaliDate::getNepaliDate();
    }
    public function salesOverTime()
    {
        return Sale::selectRaw('sale_date, SUM(quantity) as total')
        ->where('status', 'completed')
        ->groupBy('sale_date')
        ->orderBy('sale_date')
        ->get();
    }

    public function warehouseStockDistribution()
    {
        return Warehouse::withSum('warehouseStocks', 'quantity')
        ->get(['id', 'name']);
    }

    public function topProducts($limit = 10)
    {
        return StockTransaction::selectRaw('product_id, SUM(quantity) as total_sold')
        ->where('transaction_type', 'sale')
        ->groupBy('product_id')
        ->with('product:id,name')
        ->orderByDesc('total_sold')
        ->limit($limit)
        ->get();
    }

    public function stockHealth()
    {
        $products = Product::withSum('warehouseStocks', 'quantity')->get();

        return [
            'in_stock'     => $products->where('warehouse_stocks_sum_quantity', '>=', 10)->count(),
            'low_stock'    => $products->whereBetween('warehouse_stocks_sum_quantity', [1, 9])->count(),
            'out_of_stock' => $products->where('warehouse_stocks_sum_quantity', 0)->count(),
        ];
    }
    public function todaySales(){

        $salesToday =$this->salesReportQuery('today')->count();
        return $salesToday;
    }
    public function salesReportQuery(string $period = 'all')
    {
        $query = Sale::where('status', 'completed')->with('product','warehouse');

        match ($period) {
            'today' => $query->where('sale_date', ($this->todayDate)),
            'week' => $query
            ->where('created_at','>=',now()->subDays(7)),
            'month' => $query
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year),

            'year' => $query
            ->whereYear('created_at', now()->year),

            'all' => null,

            default => throw new \InvalidArgumentException('Invalid revenue period')
        };

        return $query;
    }

    public function revenue(string $period){

        $data = $this->salesReportQuery($period);
        return $data->sum('total_amount');
    }

}
