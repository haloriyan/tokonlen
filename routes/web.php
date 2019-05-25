<?php

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

// Untuk user
Route::get('/cari', 'UserController@cariProduct')->name('user.cari');
Route::get('/', 'UserController@indexPage')->name('user.index');
Route::get('/login', 'UserController@loginPage')->name('login.page');
Route::get('/register/{email}/{nama}', 'UserController@registerViaFacebook');
Route::get('/register', 'UserController@registerPage')->name('register.page');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::post('/register', 'UserController@register')->name('register');
Route::get('/produk/{id}', 'UserController@viewProduct')->name('product.view');

// user keranjang
Route::get('/keranjang', 'CartController@index')->name('cart');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::post('/cart/{id}/delete', 'CartController@delete')->name('cart.delete');

// Admin
Route::get('/admin/produk', 'AdminController@productPage')->name('admin.product');
Route::get('/admin/kategori', 'AdminController@category')->name('admin.category');

Route::get('/admin/produk/tambah', 'ProductController@create')->name('product.create');
Route::post('/admin/produk/store', 'ProductController@store')->name('product.store');
Route::post('/admin/produk/{id}/delete', 'ProductController@delete')->name('product.delete');
Route::post('/admin/produk/{id}/update', 'ProductController@update')->name('product.update');
Route::get('/admin/produk/{id}/ubah', 'ProductController@edit')->name('product.edit');

Route::get('/admin/kategori/tambah', 'CategoryController@create')->name('category.create');
Route::get('/admin/kategori/{id}/ubah', 'CategoryController@edit')->name('category.edit');

Route::get('/admin/laporan', 'AdminController@reportPage')->name('admin.report');

Route::get('/admin/konfigurasi', 'AdminController@configPage')->name('admin.config');
Route::put('/admin/konfigurasi', 'ConfigController@setConfig')->name('admin.config.set');
Route::put('/admin/konfigurasi/brand', 'ConfigController@setConfig')->name('admin.config.setBrand');

// Category
Route::get('/admin/category/all', 'CategoryController@allCat')->name('category.all');
Route::post('/admin/category/delete', 'CategoryController@delete')->name('category.delete');
Route::post('/admin/category/store', 'CategoryController@store')->name('category.store');
Route::post('/admin/category/{id}/update', 'CategoryController@update')->name('category.update');

Route::get('/curl', 'ProductController@curel');
Route::get('/test', function() {
    return "hello";
});