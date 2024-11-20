<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/edit_profile', [HomeController::class, 'edit_profile'])->name('edit_profile');
Route::post('/update_profile/{id}', [HomeController::class, 'update_profile'])->name('update_profile');
Route::get('/password_change/', [HomeController::class, 'update_password'])->name('update_password');


Route::resource('category', CategoryController::class);
Route::resource('store', StoreController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('customer', CustomerController::class);
Route::resource('product', ProductController::class);
Route::resource('invoice', InvoiceController::class);
Route::resource('role', RoleController::class);
Route::resource('user', UserController::class);
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::resource('purchase', PurchaseController::class);
Route::get('/findPrice', [InvoiceController::class, 'findPrice'])->name('findPrice');
Route::get('/findPricePurchase', [PurchaseController::class, 'findPricePurchase'])->name('findPricePurchase');
Route::get('/settings', [SettingController::class, 'settings'])->name('setting.settings');
Route::post('/settings', [SettingController::class, 'save'])->name('setting.save');
