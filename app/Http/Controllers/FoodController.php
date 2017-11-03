<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function foodProductsPage(){
        return view('pages.foodProductsPage');
    }
}
