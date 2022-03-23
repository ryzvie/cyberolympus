<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ListController;

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


Route::get('/', [LoginController::class, 'index']);
Route::post('/authUser', [LoginController::class, 'authUser']);

Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/customer/create', [CustomerController::class, 'create']);
Route::get('/customer/getCustomer', [CustomerController::class, 'getCustomer']);
Route::post('/customer/show', [CustomerController::class, 'show']);
Route::post('/customer/update', [CustomerController::class, 'update']);
Route::get('/customer/search', [CustomerController::class, 'search']);
Route::post('/customer/getdetail', [CustomerController::class, 'getdetail']);


Route::get('/list/produk', [ListController::class, 'listproduk']);
Route::get('/list/customer', [ListController::class, 'listcustomer']);
Route::get('/list/agent', [ListController::class, 'listagent']);
Route::get('/list/order', [ListController::class, 'listorder']);
Route::get('/list/order/{id}', [ListController::class, 'detailorder']);




