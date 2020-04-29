<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

//@todo check this.
Route::get('/logout-manual', function () {
    request()->session()->invalidate();
});

/**
 * redirect any request to the index method found in AppController.
 * useful in creating SPA apps.
 */
Route::get('/{any}', 'AppController@index')->where('any', '.*');