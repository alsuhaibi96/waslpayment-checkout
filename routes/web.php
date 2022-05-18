<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiTestController;

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
});

/**
 * api test routse
 */

Route::get('test', [apiTestController::class, 'index'])->name('test');
Route::get('test/response/{info}', [apiTestController::class, 'showTest'])->name('test/response');
Route::get('test/cancel/{cancel}', [apiTestController::class, 'testCancel'])->name('testCancel');
Route::get('test/cancel', [apiTestController::class, 'viewCancel'])->name('viewCancel');


