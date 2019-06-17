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

// Raja ongkir
Route::get('/ongkir/provinsi/{id?}', 'RajaongkirController@getProvince')->middleware('cors');
Route::get('/ongkir/kota/{id?}', 'RajaongkirController@getCity')->middleware('cors');

Route::get('/product/{id}/images', 'ProductController@ApiGetImages')->name('api.getProductImages');

Route::post('/images/add', 'ImagesController@store')->name('api.addProductImage');
Route::post('/images/delete', 'ImagesController@delete')->name('api.deleteProductImage');

Route::get('/test', 'ImagesController@delete');