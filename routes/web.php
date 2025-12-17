<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\WarehouseController;
use Symfony\Component\HttpKernel\HttpCache\Store;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'guest'], function(){

    // Route::get('/register',[AuthController::class,'register'])->name('register');
    // Route::post('/register',[AuthController::class,'store']);

    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
});
//admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/getProductCount/{product}', [ProductController::class, 'getProductCount'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');


    Route::get('warehouses/data', [WarehouseController::class, 'data'])->name('warehouses.data');
    Route::resource('warehouses',WarehouseController::class);

    Route::resource('stocktransactions',StockTransactionController::class)->except('data','index','show');
    Route::get('stocktransfers/data',[StockTransferController::class,'data'])->name('stocktransfers.data');
    Route::resource('stocktransfers',StockTransferController::class)->except('create');
});

//both
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
Route::get('/search', [SearchController::class, 'index'])->name('search');

    
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('stocktransactions/data', [StockTransactionController::class, 'data'])->name('stocktransactions.data');
    Route::get('/stocktransactions', [StockTransactionController::class, 'index'])->name('stocktransactions.index');
    Route::get('/stocktransactions/{product}', [StockTransactionController::class, 'show'])->name('stocktransactions.show');
    
});


//staff
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});
