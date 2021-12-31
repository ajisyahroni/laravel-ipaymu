<?php

use App\Http\Controllers\ipaymuController;
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

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/ipaymu', function () {
    return view('ipaymu-page');
});
Route::get('/ipaymu-trx-success', function () {
    return view('ipaymu-trx-success');
})->name('ipaymu-trx-success');
Route::get('/ipaymu-trx-error', function () {
    return view('ipaymu-trx-error');
})->name('ipaymu-trx-error');



Route::post('/buy-product', [ipaymuController::class, 'handleTrx']);
Route::get('/check-balance', [ipaymuController::class, 'checkBalance']);
Route::post('/check-trx-detail', [ipaymuController::class, 'checkTrxDetail']);
Route::post('/notify', [ipaymuController::class, 'notify'])->name('notify');
