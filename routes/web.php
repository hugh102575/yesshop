<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\GuestShoppingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\RegisterController;
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
Route::post('merchandise/delete_others_img', [MerchandiseController::class, 'delete_others_img'])->name('menu.delete_others_img');
Route::get('merchandise/category', [MerchandiseController::class, 'category'])->name('category');
Route::post('merchandise/category/store', [MerchandiseController::class, 'category_store'])->name('category.store');
Route::post('merchandise/category/{id}/update', [MerchandiseController::class, 'category_update'])->name('category.update');
Route::post('merchandise/category/{id}/delete', [MerchandiseController::class, 'category_delete'])->name('category.delete');
Route::get('setting/page', [SettingController::class, 'page'])->name('setting.page');
Route::get('setting/admin_info', [SettingController::class, 'admin_info'])->name('setting.admin_info');
Route::get('setting/member', [SettingController::class, 'member'])->name('setting.member');
Route::get('setting/order', [SettingController::class, 'order'])->name('setting.order');
Route::get('setting/{id}/order_edit', [SettingController::class, 'order_edit'])->name('setting.order_edit');
Route::post('setting/{id}/order_update', [SettingController::class, 'order_update'])->name('setting.order_update');
Route::post('setting/admin_update', [SettingController::class, 'admin_update'])->name('setting.admin_update');
Route::post('setting/page_update', [SettingController::class, 'page_update'])->name('setting.page_update');
Route::get('setting/get_order', [SettingController::class, 'get_order'])->name('setting.get_order');

Route::get('shop/{api_token}', [GuestShoppingController::class, 'index_']);
Route::get('shop/{api_token}/index', [GuestShoppingController::class, 'index_all']);
Route::get('shop/{api_token}/index/{cate_id}', [GuestShoppingController::class, 'index'])->name('shop.index');
Route::get('shop/{api_token}/example', [GuestShoppingController::class, 'example'])->name('shop.example');
Route::get('shop/{api_token}/login_form', [GuestShoppingController::class, 'login_form'])->name('shop.login_form');
Route::post('shop/{api_token}/logout', [GuestShoppingController::class, 'logout'])->name('shop.logout');
Route::get('shop/{api_token}/{id}/product', [GuestShoppingController::class, 'product'])->name('shop.product');
Route::post('shop/{api_token}/register', [GuestShoppingController::class, 'register'])->name('shop.register');
Route::post('shop/{api_token}/login', [GuestShoppingController::class, 'login'])->name('shop.login');
Route::get('shop/{api_token}/cart', [GuestShoppingController::class, 'cart'])->name('shop.cart');
Route::post('shop/{api_token}/add_cart', [GuestShoppingController::class, 'add_cart'])->name('shop.add_cart');
Route::post('shop/{api_token}/del_cart', [GuestShoppingController::class, 'del_cart'])->name('shop.del_cart');
Route::post('shop/{api_token}/update_cart', [GuestShoppingController::class, 'update_cart'])->name('shop.update_cart');
Route::get('shop/{api_token}/checkout', [GuestShoppingController::class, 'checkout'])->name('shop.checkout');
Route::post('shop/{api_token}/order', [GuestShoppingController::class, 'order'])->name('shop.order');
Route::get('shop/{api_token}/order', [GuestShoppingController::class, 'my_order'])->name('shop.my_order');
Route::post('shop/{api_token}/{id}/order_update', [GuestShoppingController::class, 'order_update'])->name('shop.order_update');
Route::get('shop/{api_token}/my_info', [GuestShoppingController::class, 'my_info'])->name('shop.my_info');
Route::post('shop/{api_token}/my_update', [GuestShoppingController::class, 'my_update'])->name('shop.my_update');

//Route::get('shop/{api_token}/email/verify', [GuestShoppingController::class, 'verify'])->name('shop.verify');
//Route::post('shop/{api_token}/email/resend', [GuestShoppingController::class, 'resend'])->name('shop.resend');
//Route::get('shop/{api_token}/example', [GuestShoppingController::class, 'example'])->name('shop.example');
