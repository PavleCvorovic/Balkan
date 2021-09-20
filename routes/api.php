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

    Route::post('addAsUser', 'UserController@AddAsUser');

//Kod dodavanja, dodajes sve podatke iz tabele, prvu_sliku i slike(ostale slike), poljima sa ekstenzijom _vrsta saljes tip iz njihove roditeljske tabele.
//Kod modifikovanja, ID oglasa koji se izmjenjuje saljes zajedno sa objektom u koji stoje ostale promjene







//Tehnika api
Route::get('getAll_Tehnika', 'tehnikaController@getAll');
Route::get('getId_Tehnika/{id}', 'tehnikaController@getId');
Route::get('delAll_Tehnika', 'tehnikaController@delAll');
Route::get('delId_Tehnika/{id}', 'tehnikaController@delId');
Route::get('getTypes_Tehnika', 'tehnikaController@getAllTypes');
Route::get('getType_Tehnika/{tip}', 'tehnikaController@getType');

//Hrana api
Route::get('getAll_Hrana', 'hranaController@getAll');
Route::get('getId_Hrana/{id}', 'hranaController@getId');
Route::get('delAll_Hrana', 'hranaController@delAll');
Route::get('delId_Hrana/{id}', 'hranaController@delId');
Route::get('getTypes_Hrana', 'hranaController@getAllTypes');
Route::get('getType_Hrana/{tip}', 'hranaController@getType');

//Nekretnine api
Route::get('getAll_Nekretnine', 'nekretnineController@getAll');
Route::get('getId_Nekretnine/{id}', 'nekretnineController@getId');
Route::get('delAll_Nekretnine', 'nekretnineController@delAll');
Route::get('delId_Nekretnine/{id}', 'nekretnineController@delId');
Route::get('getTypes_Nekretnine', 'nekretnineController@getAllTypes');
Route::get('getType_Nekretnine/{tip}', 'nekretnineController@getType');

//Automoto api
Route::get('getAll_Automoto', 'automotoController@getAll');
Route::get('getId_Automoto/{id}', 'automotoController@getId');
Route::get('delAll_Automoto', 'automotoController@delAll');
Route::get('delId_Automoto/{id}', 'automotoController@delId');
Route::get('getTypes_Automoto', 'automotoController@getAllTypes');
Route::get('getType_Automoto/{tip}', 'automotoController@getType');


//Odjeca api
Route::get('getAll_Odjeca', 'odjecaController@getAll');
Route::get('getId_Odjeca/{id}', 'odjecaController@getId');
Route::get('delAll_Odjeca', 'odjecaController@delAll');
Route::get('delId_Odjeca/{id}', 'odjecaController@delId');
Route::get('getTypes_Odjeca', 'odjecaController@getAllTypes');
Route::get('getType_Odjeca/{tip}', 'odjecaController@getType');

//Posao api
Route::get('getAll_Posao', 'posaoController@getAll');
Route::get('getId_Posao/{id}', 'posaoController@getId');
Route::get('delAll_Posao', 'posaoController@delAll');
Route::get('delId_Posao/{id}', 'posaoController@delId');
Route::get('getTypes_Posao', 'posaoController@getAllTypes');
Route::get('getType_Posao/{tip}', 'posaoController@getType');

//Razno api
Route::get('getAll_Razno', 'raznoController@getAll');
Route::get('getId_Razno/{id}', 'raznoController@getId');
Route::get('delAll_Razno', 'raznoController@delAll');
Route::get('delId_Razno/{id}', 'raznoController@delId');
Route::get('getTypes_Razno', 'raznoController@getAllTypes');
Route::get('getType_Razno/{tip}', 'raznoController@getType');



//Admin api
Route::post('addAutoTip', 'RootController@addAutomoto');
Route::get('delAutoTip/{id}', 'rootController@delAutomoto');
Route::get('getAutoTip', 'rootController@getAutomoto');

Route::post('addHranaTip', 'rootController@addHrana');
Route::get('delHranaTip/{id}', 'rootController@delHrana');
Route::get('getHranaTip','rootController@getHrana');

Route::post('addNekretnineTip', 'rootController@addNekretnine');
Route::get('delNekretnineTip/{id}', 'rootController@delNekretnine');
Route::get('getNekretnineTip','rootController@getNekretnine');

Route::post('addOdjecaTip', 'rootController@addOdjeca');
Route::get('delOdjecaTip/{id}', 'rootController@delOdjeca');
Route::get('getOdjecaTip','rootController@getOdjeca');

Route::post('addPosaoTip', 'rootController@addPosao');
Route::get('delPosaoTip/{id}', 'rootController@delPosao');
Route::get('getPosaoTip','rootController@getPosao');

Route::post('addRaznoTip', 'rootController@addRazno');
Route::get('delRaznoTip/{id}', 'rootController@delRazno');
Route::get('getRaznoTip','rootController@getRazno');

Route::post('addTehnikaTip', 'rootController@addTehnika');
Route::get('delTehnikaTip/{id}', 'rootController@delTehnika');
Route::get('getTehnikaTip','rootController@getTehnika');

Route::post('register','UserController@register');
Route::post('login','UserController@login');

//Saljes id korisnika
Route::get('GetPostByUser/{id}', 'UserController@getPostbyUser');

// Saljes id produkta,id korisnika i naziv tabele.
Route::post('delAsUser', 'UserController@DelAsUser');
//Saljes id produkta, ostale parametre koji pripadaju odredjenom produktu i naziv tabele.
Route::post('modAsUser', 'UserController@ModAsUser');
//Saljes parametre ,naziv tabele i id vrste tabele


Route::post('getAllId', 'UserController@GetId');
Route::post('filter', 'UserController@Filter');
Route::post('getPostsAll', 'UserController@GetPosts');
Route::get('adminGet', 'UserController@deleteAdmin');
Route::get('getAllFeatured', 'UserController@getAllFeatured');
Route::get('getAllRandom', 'UserController@getAllRandom');
Route::get('getAllNew', 'UserController@getAllNew');
Route::get('getAllCheap', 'UserController@getAllCheap');
Route::get('showUsers', 'UserController@show');
Route::get('showUser/{id}', 'UserController@showId');
Route::delete('deleteUser/{id}', 'UserController@delete');
Route::post('setAllNew', 'UserController@setAllNew');
Route::post('deleteNew', 'UserController@deleteNew');
