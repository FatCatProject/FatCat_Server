<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function foodProductsPage(){
        $currentUser = auth()->user();
        $myFoods = $this->allFoodProducts($currentUser->email);
        return view('pages.foodProductsPage',compact($myFoods));
    }


    public function allFoodProducts($user_email){
        $result =DB::table('foods')->select('foods.*')
            ->where(['user_email'=>$user_email])
            ->get();
        return $result;
    }
}
