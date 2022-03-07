<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
});

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix' => 'v1'
], function ($router) {
    Route::get('facturas', 'App\Http\Controllers\HomeController@get_invoices');
    Route::get('factura/{numero_factura}', 'App\Http\Controllers\HomeController@get_invoice');
    Route::get('facturas/{order}', 'App\Http\Controllers\HomeController@order_invoices');
    Route::post('facturas', 'App\Http\Controllers\HomeController@set_invoice');
    Route::put('facturas', 'App\Http\Controllers\HomeController@update_invoice');
});