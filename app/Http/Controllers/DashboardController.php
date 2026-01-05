<?php

namespace App\Http\Controllers;

use App\Models\Product;

use App\Services\ReportService;

class DashboardController extends Controller
{
    public function index(ReportService $reports)
    {
        $distribution = $reports->warehouseStockDistribution();

        return view('dashboard.dashboard', [
            'title'         => 'Dashboard',
            'productsCount'      => Product::count(),
            'topProducts'   => $reports->topProducts(),
            'salesTrend'    => $reports->salesOverTime(),
            'stockHealth'   => $reports->stockHealth(),
            'warehouseStocks'=> $distribution,
            'whNames'       => $distribution->pluck('name'),
            'whTotals'      => $distribution->pluck('warehouse_stocks_sum_quantity'),
            'todaySales'    =>$reports->todaySales(),
            'monthlyRevenue'=>$reports->revenue('month')
        ]);
    }



}

