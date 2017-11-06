<?php


Route::redirect('/', '/homePage', 301);

//Route::get('/getCatBreedInfo/{breed_name}' , ['uses'=>'CatController@breedInfo']);
Route::get('/getCatBreedInfo' , ['uses'=>'CatController@breedInfo']);
Route::get('/autocompleteBreed', 'CatController@autocomplete');



Auth::routes();

//added by michael
Route::get('/addCat' , ['uses'=>'CatController@addCat'])->middleware('authenticated');
Route::post('/addcat',['uses' => 'CatController@store'])->middleware('authenticated');
Route::put('/catPage/editcat',['uses' => 'CatController@update']); // no need for a middleware
Route::get('/catPage/{id}',['uses' =>'CatController@catPage'])->middleware('privacy');
Route::get('/catVetPage/{id}/{year?}', 'VetController@catVetPage')->middleware('privacy');
Route::post('/addvetlog',['uses' => 'VetController@store'])->middleware('authenticated');
Route::get('/shoppingPage/{year?}',['uses' =>'ShopController@shoppingPage'])->middleware('authenticated');
Route::post('/addShopping',['uses' => 'ShopController@storeShopLog'])->middleware('authenticated');
Route::get('/shopsPage', 'ShopController@shopsPage')->middleware('authenticated');
Route::post('/addShop',['uses' => 'ShopController@storeShop'])->middleware('authenticated');
Route::post('/addProduct',['uses' => 'ShopController@storeProduct'])->middleware('authenticated');
Route::get('/cardsPage', 'CardController@cardsPage')->middleware('authenticated');
Route::post('/addCard',['uses' => 'CardController@storeCard'])->middleware('authenticated');
Route::post('/addAdminCard',['uses' => 'CardController@storeAdminCard'])->middleware('authenticated');
Route::get('/foodProductsPage', 'FoodController@foodProductsPage')->middleware('authenticated');
Route::post('/addFood',['uses' => 'FoodController@store'])->middleware('authenticated');
Route::get('/homePage', 'HomeController@homePage')->middleware('authenticated');

//tests
Route::get('/temp/{year}' , 'VetController@yearlyVetLogs');

//Route::get('/homePage', 'PagesController@home');
Route::get('/userPage', 'PagesController@userPage');
Route::get('/boxManagePage', 'PagesController@boxManagePage');
Route::get('/editBoxPage', 'PagesController@editBoxPage');
