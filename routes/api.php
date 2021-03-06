<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{email}', 'UserController@cekUser')->name('api.cekUser');

Route::get('/product/all', 'ProductController@all');
Route::post('/product/search', 'ProductController@search')->name('api.product.search')->middleware('cors');

// Raja ongkir
Route::get('/ongkir/provinsi/{id?}', 'RajaongkirController@getProvince')->middleware('cors');
Route::get('/ongkir/kota/{id?}', 'RajaongkirController@getCity')->middleware('cors');
Route::post('/ongkir/cost', 'RajaongkirController@getCost')->middleware('cors')->name('ro.getCost');

Route::get('/product/{id}/images', 'ProductController@ApiGetImages')->name('api.getProductImages');

Route::post('/images/add', 'ImagesController@store')->name('api.addProductImage');
Route::post('/images/delete', 'ImagesController@delete')->name('api.deleteProductImage');

// Messaging
Route::post('/messaging/user/send', 'MessagingController@send')->name('api.message.user.send')->middleware('cors');
Route::post('/messaging/user/mine', 'MessagingController@mine')->name('api.message.user.mine')->middleware('cors');

Route::get('/messaging/admin/chatlist', 'MessagingController@getChatList')->name('api.message.admin.getChatList')->middleware('cors');

Route::post('/category/search', 'CategoryController@search')->name('api.searchCategory');
