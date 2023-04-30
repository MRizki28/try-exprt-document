<?php

use App\Http\Controllers\API\HpController;
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
});

Route::get('/api/export/hp', [HpController::class, 'export'])->name('hp.exports');
Route::post('/cms/api/create', [HpController::class, 'store']);
Route::get('/cms/api/hp/{uuid}', [HpController::class, 'getbyuuid']);
