<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ZipCodeController;

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

Route::get('api/zip-codes/{zip_code}', [ZipCodeController::class, 'getZipCode']);

Route::get('zip-codes/{zip_code}', [ZipCodeController::class, 'webZipCode']);
