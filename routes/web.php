<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/pagamento', function () {
//    return view('dados_pagamento');
//});

Route::get('/', [CheckoutController::class, 'index']);
Route::post('/ticketPayment', [CheckoutController::class, 'ticketPayment']);
Route::post('/cardPayment', [CheckoutController::class, 'cardPayment']);

