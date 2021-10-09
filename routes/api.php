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

Route::post('/register', 'UserController@register');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth', function () {
        return '';
    });
    //Route::get('/user', 'UserController@register');
    Route::post('/event/generate', 'EventController@generate');
    Route::get('/companies', 'CompanyController@get');
});
