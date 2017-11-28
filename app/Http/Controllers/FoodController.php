<?php

namespace App\Http\Controllers;

use App\Food;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function foodProductsPage()
    {
        $current_user = auth()->user();
        $my_foods = $this->allFoodProducts($current_user->email);
        if (count($my_foods) / 3 > intval(count($my_foods) / 3))
            $number_of_rows = intval(count($my_foods) / 3) + 1;
        else
            $number_of_rows = intval(count($my_foods)) / 3;

        $food_pictures = [];


        foreach ($my_foods as $food) {
            if (!empty($food->picture)) {
                $picture_path = str_replace(["@", "."], "_", $current_user->email) . "/" . $food->picture;
                if (Storage::disk("user_pictures")->exists($picture_path)) {
                    $food_pictures[$food->id] = "data:image/png;base64," . base64_encode(
                            Storage::disk("user_pictures")->get($picture_path)
                        );
                } else {
                    $food_pictures[$food->id] = "/images/default_food.png";
                }
            } else {
                $food_pictures[$food->id] = "/images/default_food.png";
            }
        }
        return view(
            "pages.foodProductsPage",
            [
                "numberOfRows" => $number_of_rows,
                "myFoods" => $my_foods,
                "food_pictures" => $food_pictures
            ]
        );
    }

    public function store(Request $request)
    {
        $current_user = auth()->user();
        $food = new \App\Food(
            [
                "user_email" => $current_user->email,
                "food_name" => $request->food_name
            ]
        );
        $food->picture = $request->picture;
        $food->weight_left = $request->weight_left;

        $check_duplicate = DB::table('foods')->select('foods.*')
            ->orderBy('id', 'desc')
            ->where(['user_email' => $current_user->email, 'food_name' => $food->food_name])
            ->get();
        if (count($check_duplicate) == 0) {
            try {
                if (!empty($request->picture)) {
                    $food->picture = str_replace(
                            ["@", "."],
                            "_",
                            $current_user->email . "_" . "food" . $food->food_name
                        ) . "." . $request->picture->getClientOriginalExtension();
                }

                $food->save();
                if (!empty($food->picture)) {
                    Storage::disk("user_pictures")->putFileAs(
                        str_replace(["@", "."], "_", $current_user->email),
                        $request->picture,
                        $food->picture
                    );
                }
            } catch (QueryException $e) {
                return response("QueryException - Fixme.\n", 400);
            }
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
    public function updateWeight(Request $request)
    {
        $currentUser = Auth::User();
        $my_food = $currentUser->foods()->where('id', $request->id)->first();
        if (empty($my_food))
            return response("Product not found", 204);

        $newWeight = $my_food->weight_left + $request->addFoodWeight;
        if($newWeight > 0){
            $my_food->weight_left = $newWeight;
        }
        else
            $my_food->weight_left = 0;

        try {
            $my_food->save();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json(['newWeight' => $my_food->weight_left]);
    }

    public function update(Request $request)
    {
        $current_user = Auth::User();
        $my_food = $current_user->foods()->where('id', $request->id)->first();
        $my_food_name = $request->food_name;

        if (empty($my_food))
            return response("Product not found", 204);
        else {

            $check_duplicate = DB::table('foods')->select('foods.*')
                ->orderBy('id', 'desc')
                ->where('user_email',$current_user->email)
                ->whereIn('food_name',array($request->oldname,$request->food_name))
                ->get();


            if (count($check_duplicate)<2) {
                $my_food->food_name = $my_food_name;
                if ($request->profile_picture != null) {
                    if ($my_food->picture != null) {
                        $picture_path = str_replace(["@", "."], "_", $current_user->email);
                        Storage::disk("user_pictures")->delete($picture_path . "/" . $my_food->picture);
                        $my_food->picture = null;
                    }
                    try {
                        if (!empty($request->profile_picture)) {
                            $my_food->picture = str_replace(
                                    ["@", "."],
                                    "_",
                                    $current_user->email . "_" . "food" . $my_food->food_name
                                ) . "." . $request->profile_picture->getClientOriginalExtension();
                        }
                        $my_food->save();
                        if (!empty($my_food->picture)) {
                            Storage::disk("user_pictures")->putFileAs(
                                str_replace(["@", "."], "_", $current_user->email),
                                $request->profile_picture,
                                $my_food->picture
                            );
                        }
                    } catch (QueryException $e) {
                        return response("QueryException - Fixme.\n", 400);
                    }
                }
                $my_food->update();
            }
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        $current_user = Auth::User();
        $my_food = $current_user->foods()->where('id', $id)->first();
        $picture_path = str_replace(["@", "."], "_", $current_user->email);
        if (empty($my_food)) {
            return response()->json("failed to delete food");
        } else {
            if ($my_food->picture != null) {
                Storage::disk("user_pictures")->delete($picture_path . "/" . $my_food->picture);
            }
            $my_food->delete();
            return response("", 204);
        }
    }

    public function checkFoodExists(Request $request){
        $current_user = Auth::User();
        $exists = true;
        try {
            $current_user->foods()
                ->where("food_name", "=", $request->food_name)
                ->where("id", "!=", $request->food_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $exists = false;
        }
        return response()->json(["exists" => $exists]);
    }

}

