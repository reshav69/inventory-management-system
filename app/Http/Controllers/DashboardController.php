<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\StockTransfer;
use App\Models\Warehouse;

class DashboardController extends Controller
{

    public function index(){
        return view('dashboard.dashboard', [

            'salesTrend'   => $this->salesOverTime(),

        ]);

        // $adminCount = User::where('role','admin')->count();
        // $staffCount = User::where('role','staff')->count();
        // return view('admin.dashboard',compact('adminCount','staffCount'));
    }
    // public function topProducts(){
    //     $prods=Product::where('status',1)->pluck('name','price');
    //     return $prods;


    // }
    public function salesOverTime($days=30)
    {
        return Sale::selectRaw('sale_date, SUM(total_amount) as total')
        ->where('status', 'completed')
        ->whereDate('sale_date', '>=', now()->subDays($days))
        ->groupBy('sale_date')
        ->orderBy('sale_date')
        ->get();
    }

}

