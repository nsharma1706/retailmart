<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/', [MenuController::class, 'listItem']);
Route::get('/menu', [MenuController::class, 'listItem']);
Route::post('/getCart', [CartController::class, 'getCartItems']);
Route::post('/addToCart', [CartController::class, 'addToCart']);
Route::post('/updateCart', [CartController::class, 'updateCart']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/payorder', [CheckoutController::class, 'payOrder']);