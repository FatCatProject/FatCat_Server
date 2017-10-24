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



//Route::get('/addCat' ,['uses'=>'PagesController@addCat']);
//Route::get('/getCatBreedInfo/{breed_name}' , ['uses'=>'CatController@breedInfo']);
Route::get('/getCatBreedInfo' , ['uses'=>'CatController@breedInfo']);
Route::get('/autocompleteBreed', 'CatController@autocomplete');

Route::get('/catVetPage', 'CatController@catVetPage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//added by michael
//works and needed
Route::post('/addcat',['uses' => 'CatController@store']);
Route::put('/catPage/editcat',['uses' => 'CatController@update']);
Route::get('/catPage/{id}/{date?}',['uses' =>'CatController@catPage']);
//tests
Route::get('/temp/{openTime}/{closeTime}' , 'CatController@diffBetweenDates');
Route::get('/temp/{id}/{date}' , 'CatController@monthlyFeedingLogs');
//not in use
//Route::get('temp/{string}',['uses' => 'CatController@stringToDateTime']);
//Route::get('catPage/{id}/{date}',['uses' => 'CatController@dailyFeedingLogs']);

