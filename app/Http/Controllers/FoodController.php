<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Food;

class FoodController extends Controller
{
    public function foodProductsPage()
    {
        $currentUser = auth()->user();
        $myFoods = $this->allFoodProducts($currentUser->email);
        if(count($myFoods)/3>intval(count($myFoods)/3))
            $numberOfRows=intval(count($myFoods)/3)+1;
        else
            $numberOfRows = intval(count($myFoods))/3;
        return view('pages.foodProductsPage',compact('numberOfRows'))->with('myFoods',$myFoods);
    }

    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $status = "success";

        if ($currentUser == null || $request->food_name == null || $request->weight_left == null) {
            $status = "lack of input";
        } else {

            $id = DB::table('foods')->insertGetId(
                ['user_email' => $currentUser->email, 'food_name' => $request->food_name, 'weight_left' => $request->weight_left,
                     'date_bought' => $request->date_bought, 'picture' => $request->picture]
            );
        }
        return redirect()->back();
    }


    public function allFoodProducts($user_email)
    {
        $result = DB::table('foods')->select('foods.*')
            ->where(['user_email' => $user_email])
            ->get();
        return $result;
    }

//    Natalie
    public function updateWeight(Request $request){
        $currentUser = Auth::User();
        $my_food = $currentUser->foods()->where('id', $request->id)->first();
        if(empty($my_food))
            return response("Product not found", 204);

        $newWeight=$my_food->weight_left+$request->addFoodWeight;
        $my_food->weight_left = $newWeight;

        try{
            $my_food->save();
        }catch(QueryException $e){
            return response("Update failed", 500);
        }
        return response()->json(['newWeight' => $my_food->weight_left]);
    }

    public function update(Request $request){
        $currentUser = Auth::User();
        $my_food = $currentUser->foods()->where('id', $request->id)->first();
        $my_food_name= $request->food_name;

        if(empty($my_food))
            return response("Product not found", 204);
        else {
            $my_food->food_name=$my_food_name;
            //Change image if got new image
        }
        $my_food->update();
        return redirect()->back();
    }
    public function delete($id){
        $currentUser = Auth::User();
        $my_food = $currentUser->foods()->where('id', $id)->first();
        if(empty($my_food)){
            return response()->json("failed to delete food");
        }else{
            $my_food->delete();
            //TODO dele pic from storage!
//          Storage::disc("user_pictures")->delete('$my_food->picture');
//            return redirect()->back();
            return response("", 204);
        }
    }
}
