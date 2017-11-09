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
Route::get('/catPage/{id}',['uses' =>'CatController@catPage'])->name('catPage')->middleware('privacy');
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
//Natalie
Route::get('/updateWeight',['uses' => 'FoodController@updateWeight'])->middleware('authenticated');
Route::get('/update',['uses' => 'FoodController@update'])->middleware('authenticated');
Route::post('/editFood',['uses' => 'FoodController@update'])->middleware('authenticated');
Route::get('/deleteFood/{id}','FoodController@delete')
    ->name('deleteFood')
    ->middleware('authenticated');
//Route::get('/catFields/{id}',['uses' =>'CatController@editCat'])->name('catFields')->middleware('privacy');

//tests
Route::get('/deleteVetLog/' , 'VetController@delete');

//Route::get('/homePage', 'PagesController@home');
Route::get('/userPage', 'PagesController@userPage');
Route::get('/boxManagePage', 'PagesController@boxManagePage');
Route::get('/editBoxPage', 'PagesController@editBoxPage');

Route::get('/homePage/ratio','HomeController@monthlyRatio')
    ->name('home_page_ratio')
    ->middleware('authenticated');
Route::get('/homePage/expenses','HomeController@yearlyExpenses')
    ->name('home_page_expenses')
    ->middleware('authenticated');
Route::get('/homePage/vet_visits','HomeController@yearlyVetVisits')
    ->name('home_page_vet_visits')
    ->middleware('authenticated');













//tmp new
Route::post('/addvetlog',['uses' => 'VetController@store'])->middleware('authenticated');
Route::get('/update',['uses' => 'VetController@update'])->middleware('authenticated');