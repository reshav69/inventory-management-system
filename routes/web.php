<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;

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
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');


    Route::get('warehouses/data', [WarehouseController::class, 'data'])->name('warehouses.data');
    Route::resource('warehouses',WarehouseController::class);
});
//staff
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});


//both
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/data', [ProductController::class, 'data'])->name('products.data');
    

});