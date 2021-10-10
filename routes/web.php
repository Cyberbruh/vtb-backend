<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::get('/', 'MainController@index')->name('index');

Route::get('/admin/login', 'MainController@admin_login');

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'MainController@admin')->name('admin.index');
    Route::get('/tag', 'TagController@form')->name('tag.form');
    Route::post('/tag', 'TagController@create')->name('tag.create');
    Route::get('/company', 'CompanyController@form')->name('company.form');
    Route::post('/company', 'CompanyController@create')->name('company.create');
    Route::get('/company/delete/{company}', 'CompanyController@delete')->name('company.delete');
    Route::get('/event', 'EventController@form')->name('event.form');
    Route::post('/event', 'EventController@create')->name('event.create');
    Route::get('/event/delete/{event}', 'EventController@delete')->name('event.delete');
});
