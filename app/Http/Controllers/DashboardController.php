<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StockTransaction;
use App\Models\StockTransfer;
use App\Models\Warehouse;
use App\Traits\HasNepaliDate;

class DashboardController extends Controller
{
    public function index(){

        $distribution = $this->warehouseStockDistribution();
        return view('dashboard.dashboard', [
            'topProducts'=>$this->topProducts(),
            'salesTrend'   => $this->salesOverTime(),
            'stockHealth'=>$this->stockHealth(),
            'warehouseStocks'=>$this->warehouseStockDistribution(),
            'whNames'  => $distribution->pluck('name'),
            'whTotals' => $distribution->pluck('warehouse_stocks_sum_quantity'),
        ]);

    }


    // }
    public function salesOverTime($days=30)
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
            'in_stock' => $products->where('warehouse_stocks_sum_quantity', '>=', 10)->count(),
            'low_stock' => $products->whereBetween('warehouse_stocks_sum_quantity', [1, 9])->count(),
            'out_of_stock' => $products->where('warehouse_stocks_sum_quantity', 0)->count(),
        ];
    }

}

