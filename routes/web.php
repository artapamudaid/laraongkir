<?php

use Illuminate\Support\Facades\Route;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/get_province', [CheckoutController::class, 'get_province']);
Route::get('/get_city/{id}', [CheckoutController::class, 'get_city']);
Route::get(
    '/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}',
    [CheckoutController::class, 'get_ongkir']
);
