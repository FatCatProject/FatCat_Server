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
Route::get('/catPage' , ['uses'=>'CatController@catPage']);
//Route::get('/addCat' ,['uses'=>'PagesController@addCat']);
//Route::get('/getCatBreedInfo/{breed_name}' , ['uses'=>'CatController@breedInfo']);
Route::get('/getCatBreedInfo' , ['uses'=>'CatController@breedInfo']);
Route::get('/autocompleteBreed', 'CatController@autocomplete');

Route::get('/catVetPage', 'CatController@catVetPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//added by michael
Route::post('addcat',['uses' => 'CatController@store']);
Route::get('/temp' , 'CatController@myCats');
Route::get('catPage/{id}',['uses' => 'CatController@dailyEating']);

//temp
Route::get('/temp2',['uses' => 'CatController@create1']);
Route::post('foodboxes',['uses' => 'CatController@store1']);
Route::get('/temp3',['uses' => 'CatController@create2']);
Route::post('cards',['uses' => 'CatController@store2']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
