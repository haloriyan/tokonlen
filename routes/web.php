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
Route::get('/login', 'UserController@loginPage')->name('user.login');
Route::get('/login/facebook', 'UserController@loginFacebook')->name('login.facebook');
Route::get('/login/google', 'UserController@loginGoogle')->name('login.google');
Route::get('/register/facebook/{email}/{nama}', 'UserController@registerViaFacebook');
Route::get('/register/google/{email}/{nama}', 'UserController@registerViaGoogle');
Route::get('/register', 'UserController@registerPage')->name('register.page');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/profil/pengaturan', 'UserController@settings')->name('user.settings');
Route::post('/profil/pengaturan', 'UserController@saveSettings')->name('user.settings.save');
Route::post('/register', 'UserController@register')->name('register');
Route::get('/produk/{id}', 'UserController@viewProduct')->name('product.view');
Route::get('/produk/{id}#tulis-ulasan', 'UserController@viewProduct')->name('review.write');
Route::get('/orderan-saya', 'OrderanController@mine')->name('user.orderan');
Route::get('/order/{id}', 'OrderanController@detailOrder')->name('order.detail');
Route::get('/cara-membayar', 'PaymentController@paymentPage')->name('payment.page');
Route::get('/konfirmasi/{id?}', 'OrderanController@confirmationPage')->name('confirmation.page');
Route::post('/konfirmasi', 'PaymentController@confirmation')->name('confirmation.store');

// user keranjang
Route::get('/keranjang', 'CartController@index')->name('cart');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::post('/cart/{id}/delete', 'CartController@delete')->name('cart.delete');

// User Checkout
Route::get('/orderan/{id}', 'OrderanController@checkout')->name('order.checkout');

// Admin
Route::get('/admin/produk', 'AdminController@productPage')->name('admin.product');
Route::get('/admin/kategori', 'AdminController@category')->name('admin.category');
Route::get('/admin/konfirmasi', 'AdminController@confirmationPage')->name('admin.confirmation');
Route::get('/admin/bukti/{id}', 'PaymentController@showEvidence')->name('evidence');

Route::post('/admin/konfirmasi/{id}', 'PaymentController@paymentConfirmation')->name('payment.confirmation');

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

Route::get('/admin/pembayaran', 'AdminController@paymentPage')->name('admin.payment');
Route::get('/admin/pembayaran/tambah', 'PaymentController@create')->name('payment.create');

// Category Controller
Route::get('/admin/category/all', 'CategoryController@allCat')->name('category.all');
Route::post('/admin/category/delete', 'CategoryController@delete')->name('category.delete');
Route::post('/admin/category/store', 'CategoryController@store')->name('category.store');
Route::post('/admin/category/{id}/update', 'CategoryController@update')->name('category.update');

// Payment Controller
Route::get('/admin/payment/all', 'PaymentController@allPayment')->name('payment.all');
Route::post('/admin/payment/store', 'PaymentController@store')->name('payment.store');
Route::post('/admin/payment/{id}/update', 'PaymentController@update')->name('payment.update');
Route::post('/admin/payment/delete', 'PaymentController@delete')->name('payment.delete');
Route::get('/admin/pembayaran/{id}/ubah', 'PaymentController@edit')->name('payment.edit');

// Route::get('/test/{user_id}/{product_id}', 'ReviewController@canIWriteReview');
Route::get('/test', 'ReviewController@testFunc');