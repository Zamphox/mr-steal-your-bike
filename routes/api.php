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

Route::group(['prefix' => 'case'], function () {
    Route::post('report', 'CasesController@create');
    Route::post('close/{id}', 'CasesController@close');
});

Route::group(['prefix' => 'officers'], function () {
    Route::get('status', 'CasesController@getOfficerCase');
});
