<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Restricts api access only to authenticated users.
 */
// Route::middleware('auth:api')->group(function()
// {


// });

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});

/**
 * Contacts endpoint CRUD.
 */

Route::post('/contact', 'ContactsController@store');
Route::get('/contact/{contact}', 'ContactsController@show');
// Route::patch('/contacts/{contact}', 'ContactsController@update');
// Route::delete('/contacts/{contact}', 'ContactsController@destroy');