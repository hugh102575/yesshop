<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\GuestShoppingController;
use App\Http\Controllers\SettingController;
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

/*
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/

Auth::routes(['verify' => true]);
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('merchandise/menu', [MerchandiseController::class, 'menu'])->name('menu');
Route::get('merchandise/create', [MerchandiseController::class, 'create'])->name('menu.create');
Route::get('merchandise/{id}/edit', [MerchandiseController::class, 'edit'])->name('menu.edit');
Route::post('merchandise/store', [MerchandiseController::class, 'store'])->name('menu.store');
Route::post('merchandise/{id}/update', [MerchandiseController::class, 'update'])->name('menu.update');
Route::post('merchandise/{id}/delete', [MerchandiseController::class, 'delete'])->name('menu.delete');
Route::get('merchandise/category', [MerchandiseController::class, 'category'])->name('category');
Route::post('merchandise/category/store', [MerchandiseController::class, 'category_store'])->name('category.store');
Route::post('merchandise/category/{id}/update', [MerchandiseController::class, 'category_update'])->name('category.update');
Route::post('merchandise/category/{id}/delete', [MerchandiseController::class, 'category_delete'])->name('category.delete');
Route::get('setting/page', [SettingController::class, 'page'])->name('setting.page');
Route::post('setting/update', [SettingController::class, 'update'])->name('setting.update');

Route::get('shop/{api_token}/index/{cate_id}', [GuestShoppingController::class, 'index'])->name('shop.index');
Route::get('shop/{api_token}/example', [GuestShoppingController::class, 'example'])->name('shop.example');
Route::get('shop/{api_token}/login', [GuestShoppingController::class, 'login'])->name('shop.login');
Route::get('shop/{api_token}/{id}/product', [GuestShoppingController::class, 'product'])->name('shop.product');
