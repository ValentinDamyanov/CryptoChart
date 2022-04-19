<?php

use App\Http\Controllers\HomeController;
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

Route::get('/fake/{num}', [HomeController::class, 'faker']);
Route::get('/', [HomeController::class, 'index']);
Route::post('/add_to_price_alert', [HomeController::class, 'addToPriceAlert']);
