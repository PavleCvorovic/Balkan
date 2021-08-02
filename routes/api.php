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
//Kod dodavanja, dodajes sve podatke iz tabele, prvu_sliku i slike(ostale slike), poljima sa ekstenzijom _vrsta saljes tip iz njihove roditeljske tabele.
//Kod modifikovanja, ID oglasa koji se izmjenjuje saljes zajedno sa objektom u koji stoje ostale promjene


//Tehnika api
Route::get('getAll_Tehnika', 'tehnikaController@getAll');
Route::get('getId_Tehnika/{id}', 'tehnikaController@getId');
Route::get('delAll_Tehnika', 'tehnikaController@delAll');
Route::get('delId_Tehnika/{id}', 'tehnikaController@delId');
Route::post('addPost_Tehnika', 'tehnikaController@addPost');
Route::post('modPost_Tehnika', 'tehnikaController@modPostbyId');
Route::get('getTypes_Tehnika', 'tehnikaController@getAllTypes');
Route::get('getType_Tehnika/{tip}', 'tehnikaController@getType');
Route::post('filter_Tehnika', 'tehnikaController@Filter');
//Hrana api
Route::get('getAll_Hrana', 'hranaController@getAll');
Route::get('getId_Hrana/{id}', 'hranaController@getId');
Route::get('delAll_Hrana', 'hranaController@delAll');
Route::get('delId_Hrana/{id}', 'hranaController@delId');
Route::post('addPost_Hrana', 'hranaController@addPost');
Route::post('modPost_Hrana', 'hranaController@modPostbyId');
Route::get('getTypes_Hrana', 'hranaController@getAllTypes');
Route::get('getType_Hrana/{tip}', 'hranaController@getType');
Route::post('filter_Hrana', 'hranaController@Filter');
//Nekretnine api
Route::get('getAll_Nekretnine', 'nekretnineController@getAll');
Route::get('getId_Nekretnine/{id}', 'nekretnineController@getId');
Route::get('delAll_Nekretnine', 'nekretnineController@delAll');
Route::get('delId_Nekretnine/{id}', 'nekretnineController@delId');
Route::post('addPost_Nekretnine', 'nekretnineController@addPost');
Route::post('modPost_Nekretnine', 'nekretnineController@modPostbyId');
Route::get('getTypes_Nekretnine', 'nekretnineController@getAllTypes');
Route::get('getType_Nekretnine/{tip}', 'nekretnineController@getType');
Route::post('filter_Nekretnine', 'nekretnineController@Filter');
//Automoto api
Route::get('getAll_Automoto', 'automotoController@getAll');
Route::get('getId_Automoto/{id}', 'automotoController@getId');
Route::get('delAll_Automoto', 'automotoController@delAll');
Route::get('delId_Automoto/{id}', 'automotoController@delId');
Route::post('addPost_Automoto', 'automotoController@addPost');
Route::post('modPost_Automoto', 'automotoController@modPostbyId');
Route::get('getTypes_Automoto', 'automotoController@getAllTypes');
Route::get('getType_Automoto/{tip}', 'automotoController@getType');
Route::post('filter_Automoto', 'automotoController@Filter');

//Odjeca api
Route::get('getAll_Odjeca', 'odjecaController@getAll');
Route::get('getId_Odjeca/{id}', 'odjecaController@getId');
Route::get('delAll_Odjeca', 'odjecaController@delAll');
Route::get('delId_Odjeca/{id}', 'odjecaController@delId');
Route::post('addPost_Odjeca', 'odjecaController@addPost');
Route::post('modPost_Odjeca', 'odjecaController@modPostbyId');
Route::get('getTypes_Odjeca', 'odjecaController@getAllTypes');
Route::get('getType_Odjeca/{tip}', 'odjecaController@getType');
Route::post('filter_Odjeca', 'odjecaController@Filter');
//Posao api
Route::get('getAll_Posao', 'posaoController@getAll');
Route::get('getId_Posao/{id}', 'posaoController@getId');
Route::get('delAll_Posao', 'posaoController@delAll');
Route::get('delId_Posao/{id}', 'posaoController@delId');
Route::post('addPost_Posao', 'posaoController@addPost');
Route::post('modPost_Posao', 'posaoController@modPostbyId');
Route::get('getTypes_Posao', 'posaoController@getAllTypes');
Route::get('getType_Posao/{tip}', 'posaoController@getType');
Route::post('filter_Posao', 'posaoController@Filter');
//Razno api
Route::get('getAll_Razno', 'raznoController@getAll');
Route::get('getId_Razno/{id}', 'raznoController@getId');
Route::get('delAll_Razno', 'raznoController@delAll');
Route::get('delId_Razno/{id}', 'raznoController@delId');
Route::post('addPost_Razno', 'raznoController@addPost');
Route::post('modPost_Razno', 'raznoController@modPostbyId');
Route::get('getTypes_Razno', 'raznoController@getAllTypes');
Route::get('getType_Razno/{tip}', 'raznoController@getType');
Route::post('filter_Razno', 'raznoController@Filter');


//Admin api
Route::post('addAutoTip/{tip}', 'rootController@addAutomoto');
Route::get('delAutoTip/{id}', 'rootController@delAutomoto');
Route::get('getAutoTip', 'rootController@getAutomoto');

Route::post('addHranaTip/{tip}', 'rootController@addHrana');
Route::get('delHranaTip/{id}', 'rootController@delHrana');
Route::get('getHranaTip','rootController@delHrana');

Route::post('addNekretnineTip/{tip}', 'rootController@addNekretnine');
Route::get('delNekretnineTip/{id}', 'rootController@delNekretnine');
Route::get('getNekretnineTip','rootController@delNekretnine');

Route::post('addOdjecaTip/{tip}', 'rootController@addOdjeca');
Route::get('delOdjecaTip/{id}', 'rootController@delOdjeca');
Route::get('getOdjecaTip','rootController@delOdjeca');

Route::post('addPosaoTip/{tip}', 'rootController@addPosao');
Route::get('delPosaoTip/{id}', 'rootController@delPosao');
Route::get('getPosaoTip','rootController@delPosao');

Route::post('addRaznoTip/{tip}', 'rootController@addRazno');
Route::get('delRaznoTip/{id}', 'rootController@delRazno');
Route::get('getRaznoTip','rootController@delRazno');

Route::post('addTehnikaTip/{tip}', 'rootController@addTehnika');
Route::get('delTehnikaTip/{id}', 'rootController@delTehnika');
Route::get('getTehnikaTip','rootController@delTehnika');

Route::post('register','UserController@register');
Route::post('login','UserController@login');

