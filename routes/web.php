<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;


Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'guest'], function(){

    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'store']);

    Route::get('/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);
});
//admin
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::get('/products/trashdata', [ProductController::class, 'trashData'])->name('products.trashData');
    Route::put('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{id}/forcedelete', [ProductController::class, 'forceDelete'])->name('products.forcedelete');

       Route::get('/warehouses/trash', [WarehouseController::class, 'trash'])->name('warehouses.trash');
    Route::get('/warehouses/trashdata', [WarehouseController::class, 'trashData'])->name('warehouses.trashData');
    Route::put('/warehouses/{id}/restore', [WarehouseController::class, 'restore'])->name('warehouses.restore');
    Route::delete('/warehouses/{id}/forcedelete', [WarehouseController::class, 'forceDelete'])->name('warehouses.forcedelete');
    Route::get('warehouses/data', [WarehouseController::class, 'data'])->name('warehouses.data');
    Route::resource('warehouses',WarehouseController::class);
    
    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::resource('users',UserController::class);
});

//both
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/products/{product}/warehouses', [ProductController::class, 'warehouses'])
    ->name('products.warehouses');
    Route::get('/products/all-products',[ProductController::class,'products'])->name('products.allproducts');
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    Route::get('stocktransactions/data', [StockTransactionController::class, 'data'])->name('stocktransactions.data');

    Route::resource('stocktransactions',StockTransactionController::class)->only('create','show','index','store');
    Route::get('stocktransfers/data',[StockTransferController::class,'data'])->name('stocktransfers.data');
    Route::resource('stocktransfers',StockTransferController::class)->except('create');
    
    Route::get('sales/data',[SaleController::class,'data'])->name('sales.data');
    Route::post('sales/{sale}/refund',[SaleController::class,'refund'])->name('sales.refund');
    Route::resource('sales',SaleController::class);
    
});

