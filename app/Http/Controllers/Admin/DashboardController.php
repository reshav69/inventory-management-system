<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index(){
        $adminCount = User::where('role', 'admin')->count();
        $staffCount = User::where('role', 'staff')->count();
        $productWithPrices = Product::where('status',1)->pluck('name','price');

        return view('admin.dashboard', compact('adminCount', 'staffCount','productWithPrices'));

        // $adminCount = User::where('role','admin')->count();
        // $staffCount = User::where('role','staff')->count();
        // return view('admin.dashboard',compact('adminCount','staffCount'));
    }
}
