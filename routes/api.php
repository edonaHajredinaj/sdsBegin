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
Route::delete('products/{id}', 'Products@delete');


Route::get('sales', 'Sales@all');
Route::get('sales/{id}', 'Sales@get');
Route::post('sales', 'Sales@store');
Route::put('sales/{id}', 'Sales@update');
Route::delete('sales/{id}', 'Sales@delete');


Route::get('stocks', 'Stocks@all');
Route::get('stocks/{id}', 'Stocks@get');
Route::post('stocks', 'Stocks@store');
Route::put('stocks/{id}', 'Stocks@update');
Route::delete('stocks/{id}', 'Stocks@delete');
