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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Tehnika api
Route::get('getall_Tehnika', 'tehnikaController@getAll');
Route::get('getid_Tehnika/{id}', 'tehnikaController@getId');
Route::get('delall_Tehnika', 'tehnikaController@delAll');
Route::get('delId_Tehnika/{id}', 'tehnikaController@delId');
Route::post('addPost_Tehnika', 'tehnikaController@addPost');
//Hrana api
Route::get('getall_Hrana', 'hranaController@getAll');
Route::get('getid_Hrana/{id}', 'hranaController@getId');
Route::get('delall_Hrana', 'hranaController@delAll');
Route::get('delId_Hrana/{id}', 'hranaController@delId');
Route::post('addPost_Hrana', 'hranaController@addPost');
//Nekretnine api
Route::get('getall_Nekretnine', 'nekretnineController@getAll');
Route::get('getid_Nekretnine/{id}', 'nekretnineController@getId');
Route::get('delall_Nekretnine', 'nekretnineController@delAll');
Route::get('delId_Nekretnine/{id}', 'nekretnineController@delId');
Route::post('addPost_Nekretnine', 'nekretnineController@addPost');
