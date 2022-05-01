<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Admin\{AuthController, ProfileController, UserController, CategoryController, CouponController, SizeController, ColorController, ProductController, BrandController, TaxController};
use App\Http\Controllers\Site\SiteController;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('postLogin');

Route::group(['middleware'=>['admin_auth']],function(){
    Route::get('/admin/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/logout', [ProfileController::class, 'logout'])->name('logout'); 
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/admin/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('/admin/dashboard', [ProfileController::class, 'store'])->name('store');
    Route::put('/admin/dashboard/{todolist}', [ProfileController::class, 'update'])->name('update');
    Route::delete('/admin/dashboard/{todolist}', [ProfileController::class, 'destroy'])->name('destroy');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/admin/category/manage', [CategoryController::class, 'manage'])->name('category.manage');
    Route::get('/admin/category/manage/{id}', [CategoryController::class, 'manage'])->name('category.manage');
    Route::post('/admin/category/process', [CategoryController::class, 'process'])->name('category.process');
    Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/admin/size', [SizeController::class, 'index'])->name('size');
    Route::get('/admin/size/manage', [SizeController::class, 'manage'])->name('size.manage');
    Route::get('/admin/size/manage/{id}', [SizeController::class, 'manage'])->name('size.manage');
    Route::post('/admin/size/process', [SizeController::class, 'process'])->name('size.process');
    Route::put('/admin/size/status/{status}/{id}', [SizeController::class, 'status'])->name('size.status');
    Route::delete('/admin/size/delete/{id}', [SizeController::class, 'destroy'])->name('size.destroy');

    Route::get('/admin/color', [ColorController::class, 'index'])->name('color');
    Route::get('/admin/color/manage', [ColorController::class, 'manage'])->name('color.manage');
    Route::get('/admin/color/manage/{id}', [ColorController::class, 'manage'])->name('color.manage');
    Route::post('/admin/color/process', [ColorController::class, 'process'])->name('color.process');
    Route::put('/admin/color/status/{status}/{id}', [ColorController::class, 'status'])->name('color.status');
    Route::delete('/admin/color/delete/{id}', [ColorController::class, 'destroy'])->name('color.destroy');

    Route::get('/admin/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('/admin/brand/manage', [BrandController::class, 'manage'])->name('brand.manage');
    Route::get('/admin/brand/manage/{id}', [BrandController::class, 'manage'])->name('brand.manage');
    Route::post('/admin/brand/process', [BrandController::class, 'process'])->name('brand.process');
    Route::put('/admin/brand/status/{status}/{id}', [BrandController::class, 'status'])->name('brand.status');
    Route::delete('/admin/brand/delete/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');

    Route::get('/admin/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/admin/coupon/manage', [CouponController::class, 'manage'])->name('coupon.manage');
    Route::get('/admin/coupon/manage/{id}', [CouponController::class, 'manage'])->name('coupon.manage');
    Route::post('/admin/coupon/process', [CouponController::class, 'process'])->name('coupon.process');
    Route::put('/admin/coupon/status/{status}/{id}', [CouponController::class, 'status'])->name('coupon.status');
    Route::delete('/admin/coupon/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

    Route::get('/admin/tax', [TaxController::class, 'index'])->name('tax');
    Route::get('/admin/tax/manage', [TaxController::class, 'manage'])->name('tax.manage');
    Route::get('/admin/tax/manage/{id}', [TaxController::class, 'manage'])->name('tax.manage');
    Route::post('/admin/tax/process', [TaxController::class, 'process'])->name('tax.process');
    Route::put('/admin/tax/status/{status}/{id}', [TaxController::class, 'status'])->name('tax.status');
    Route::delete('/admin/tax/delete/{id}', [TaxController::class, 'destroy'])->name('tax.destroy');

    Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
    Route::get('/admin/product/manage', [ProductController::class, 'manage'])->name('product.manage');
    Route::get('/admin/product/manage/{id}', [ProductController::class, 'manage'])->name('product.manage');
    Route::post('/admin/product/process', [ProductController::class, 'process'])->name('product.process');
    Route::put('/admin/product/status/{status}/{id}', [ProductController::class, 'status'])->name('product.status');
    Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::delete('/admin/product/productAttr_delete/{id}/{pid}', [ProductController::class, 'productAttr_delete'])->name('product.productAttr_delete');    
});
