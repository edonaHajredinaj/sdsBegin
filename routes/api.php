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

Route::get('types', 'Types@all');
Route::get('types/{id}', 'Types@get');
Route::post('types', 'Types@store');
Route::put('types', 'Types@update');
Route::delete('types', 'Types@delete');


Route::get('products', 'Products@all');
Route::get('products/{id}', 'Products@get');
Route::post('products', 'Products@store');
Route::put('products', 'Products@update');
Route::delete('products', 'Products@delete');


Route::get('stocks', 'Stocks@all');
Route::get('stocks/{id}', 'Stocks@get');
Route::post('stocks', 'Stocks@store');
Route::put('stocks', 'Stocks@update');
Route::delete('stocks', 'Stocks@delete');


Route::get('sales', 'Sales@all');
Route::get('sales/{id}', 'Sales@get');
Route::post('sales', 'Sales@store');
Route::put('sales', 'Sales@update');
Route::delete('sales', 'Sales@delete');


//$router = $this->app['router'];

Route::group([
    //'middleware' => 'auth.jwt', 
    'prefix' => 'auth'], function () {

        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
});