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

Route::get('/homePage', 'PagesController@home');
Route::get('/shoppingPage', 'PagesController@shop');
Route::get('/shopsPage', 'PagesController@shopList');