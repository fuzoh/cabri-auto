<?php

use App\Http\Controllers\ViewAnniversaryReservations;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('anniversary')
    ->name('anniversary.')
    ->group(function () {
        Route::view('/import-data', 'anniversary.import-data')
            ->name('import-data-view');
        Route::post('/import-data', ViewAnniversaryReservations::class)
            ->name('import-data');
    });
