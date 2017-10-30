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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//added by michael
//works and needed
Route::post('/addcat',['uses' => 'CatController@store']);
Route::put('/catPage/editcat',['uses' => 'CatController@update']);
Route::get('/catPage/{id}/{date?}',['uses' =>'CatController@catPage']);
Route::get('/catVetPage/{id}/{year?}', 'VetController@catVetPage');
Route::post('/addvetlog',['uses' => 'VetController@store']);
Route::get('/shoppingPage/{year?}',['uses' =>'ShopController@shoppingPage']);
Route::post('/addShopping',['uses' => 'ShopController@storeShopLog']);



//tests
Route::get('/temp/{year}' , 'VetController@yearlyVetLogs');


Route::get('/homePage', 'PagesController@home');
Route::get('/shoppingPage', 'PagesController@shop');
Route::get('/shopsPage', 'PagesController@shopList');
Route::get('/userPage', 'PagesController@userPage');
Route::get('/boxManagePage', 'PagesController@boxManagePage');
Route::get('/editBoxPage', 'PagesController@editBoxPage');
Route::get('/cardsPage', 'PagesController@cardsPage');