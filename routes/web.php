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
Route::get('/profil/pengaturan', 'UserController@settings')->name('user.settings')->middleware('User');
Route::post('/profil/pengaturan', 'UserController@saveSettings')->name('user.settings.save');
Route::post('/register', 'UserController@register')->name('register');
Route::get('/produk/{id}', 'UserController@viewProduct')->name('product.view');
Route::get('/produk/{id}#tulis-ulasan', 'UserController@viewProduct')->name('review.write');
Route::get('/orderan-saya', 'OrderanController@mine')->name('user.orderan')->middleware('User');
Route::get('/order/{id}', 'OrderanController@detailOrder')->name('order.detail')->middleware('User');
Route::get('/cara-membayar', 'PaymentController@paymentPage')->name('payment.page');
Route::get('/cs', 'UserController@csPage')->name('user.cs')->middleware('User');
Route::get('/konfirmasi/{id?}', 'OrderanController@confirmationPage')->name('confirmation.page')->middleware('User');
Route::post('/konfirmasi', 'PaymentController@confirmation')->name('confirmation.store')->middleware('User');
Route::post('/barang-sampai', 'OrderanController@barangSampai')->name('barangSampai')->middleware('User');

// user keranjang
Route::get('/keranjang', 'CartController@index')->name('cart')->middleware('User');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::post('/cart/{id}/delete', 'CartController@delete')->name('cart.delete');
// user review
Route::post('/review', 'ReviewController@store')->name('review.store');
// User Checkout
Route::get('/orderan/{id}', 'OrderanController@checkout')->name('order.checkout')->middleware('User');
// User Notification
Route::get('/notifikasi', 'UserController@notificationPage')->name('notification')->middleware('User');

// Admin
Route::get('/admin', function() {
    return redirect()->route('admin.login');
});
Route::get('/admin/produk', 'AdminController@productPage')->name('admin.product')->middleware('Admin');
Route::get('/admin/kategori', 'AdminController@category')->name('admin.category')->middleware('Admin');
Route::get('/admin/konfirmasi', 'AdminController@confirmationPage')->name('admin.confirmation')->middleware('Admin');
Route::get('/admin/bukti/{id}', 'PaymentController@showEvidence')->name('evidence')->middleware('Admin');
Route::get('/admin/laporan', 'AdminController@reportPage')->name('admin.report')->middleware('Admin');
Route::get('/admin/setelan', 'AdminController@configPage')->name('admin.config')->middleware('Admin');
Route::get('/admin/login', 'AdminController@loginPage')->name('admin.login');
Route::get('/admin/perpesanan', 'AdminController@messagingPage')->name('admin.messaging');
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

Route::get('/tuested', 'MessagingController@getChatList');

Route::post('/admin/login', 'AdminController@login')->name('admin.login.action');

Route::post('/admin/konfirmasi/{id}', 'PaymentController@paymentConfirmation')->name('payment.confirmation');

Route::get('/admin/produk/tambah', 'ProductController@create')->name('product.create');
Route::post('/admin/produk/store', 'ProductController@store')->name('product.store');
Route::post('/admin/produk/{id}/delete', 'ProductController@delete')->name('product.delete');
Route::post('/admin/produk/{id}/update', 'ProductController@update')->name('product.update');
Route::get('/admin/produk/{id}/ubah', 'ProductController@edit')->name('product.edit');

Route::get('/admin/kategori/tambah', 'CategoryController@create')->name('category.create');
Route::get('/admin/kategori/{id}/ubah', 'CategoryController@edit')->name('category.edit');

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
Route::get('/admin/payment/{id}/ubah', 'PaymentController@edit')->name('payment.edit');

Route::get('/test', 'ReviewController@testFunc');