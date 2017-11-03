<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Cat;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function cardsPage()
    {
        $currentUser = auth()->user();
        $myRegularCards = $this->myCards($currentUser->email);
        $myAdminCards = $this->myAdminCards($currentUser->email);
        $myCards = array_merge($myAdminCards,$myRegularCards);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);
        return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));
    }

    //foreign key error - will fix later
    public function storeCard(Request $request)
    {
        $currentUser = auth()->user();
        $status = "succes";
        dd($currentUser->email);
        if ($currentUser == null || $request->card_id == null || $request->card_name == null || $request->foodbox_id == null) {
            $status = "failed, input lacking";
        } else {
            $now = new DateTime();
            DB::table('cards')->insert(
                ['user_email' => $currentUser->email, 'foodbox_id' => $request->foodbox_id, 'card_id' => $request->card_id,
                    'card_name' => $request->card_name, 'created_at' => $now,
                    'updated_at' => $now, 'cat_id' => $request->cat_id]
            );
        }
        $myRegularCards = $this->myCards($currentUser->email);
        $myAdminCards = $this->myAdminCards($currentUser->email);
        $myCards = array_merge($myAdminCards,$myRegularCards);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);

        return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));
    }

    public function storeAdminCard(Request $request)
    {
        date_default_timezone_set('Asia/Jerusalem');
        $currentUser = auth()->user();
        $myCards = $this->myCards($currentUser->email);
        $myAdminCards = $this->myAdminCards($currentUser->email);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);
        $status = "succes";
        if ($currentUser == null || $request->card_id == null || $request->card_name == null ) {
            $status = "failed, input lacking";
        } else {
            $now = new DateTime();
            DB::table('admin_cards')->insert(
                ['user_email' => $currentUser->email, 'card_id' => $request->card_id, 'card_name' => $request->card_name,
                    'created_at' => $now, 'updated_at' => $now]
            );
        }
        //return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));
        return redirect()->back();
    }

    public function myCards($user_email)
    {
        $result = DB::table('cards')->select('cards.*')
            ->where('user_email', $user_email)
            ->orderBy('foodbox_id', 'desc')
            ->get();

        $result = json_decode($result,true);
        for($i=0;$i<count($result);$i++){
            $catName= Cat::find($result[$i]['cat_id'])->cat_name;
            $result[$i]['cat_name'] = $catName;
        }
        return $result;
    }

    public function myAdminCards($user_email){
        $result = DB::table('admin_cards')->select('admin_cards.*')
            ->where('user_email', $user_email)
            ->orderBy('card_id', 'desc')
            ->get();

        $result = json_decode($result,true);
        return $result;
    }

    //should be in foodbox controller when the is one
    public function myFoodBoxes($user_email)
    {
        $result = DB::table('foodboxes')->select('foodboxes.*')
            ->where('user_email', $user_email)
            ->orderBy('foodbox_id', 'desc')
            ->get();
        return $result;
    }
}
