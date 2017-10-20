<?php

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

//Route::get('/', function () {
//    return view('layouts/master');
//});
Route::get('/' , 'PagesController@index');
Route::get('/addCat' , ['uses'=>'CatController@addCat']);


Route::get('/catPage/{id}',['uses' =>'CatController@catPage']);  // By Natalie



//Route::get('/addCat' ,['uses'=>'PagesController@addCat']);
//Route::get('/getCatBreedInfo/{breed_name}' , ['uses'=>'CatController@breedInfo']);
Route::get('/getCatBreedInfo' , ['uses'=>'CatController@breedInfo']);
Route::get('/autocompleteBreed', 'CatController@autocomplete');

Route::get('/catVetPage', 'CatController@catVetPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//added by michael
Route::post('/cataction',['uses' => 'CatController@requestFromCatFields']);


Route::get('/temp' , 'CatController@myCats');
Route::get('temp/{string}',['uses' => 'CatController@stringToDateTime']);
Route::get('catPage/{id}/{date}',['uses' => 'CatController@dailyFeedingLogs']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');