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
//        $myRegularCards = $this->myCards($currentUser->email);
        $user_cards = $currentUser->cards;
        $myRegularCards = [];
        foreach($user_cards as $card){
            array_push(
                $myRegularCards,
                [
                    "id" => $card->id,
                    "user_email" => $card->user_email,
                    "foodbox_id" => $card->foodbox_id,
                    "foodbox_name" => $card->foodbox->foodbox_name,
                    "card_id" => $card->card_id,
                    "card_name" => $card->card_name,
                    "active" => $card->active,
                    "synced_to_brainbox" => $card->synced_to_brainbox,
                    "cat_id" => $card->cat_id,
                    "cat_name" => $card->cat->cat_name
                ]
            );
        }
        $myAdminCards = $this->myAdminCards($currentUser->email);
        $myCards = array_merge($myAdminCards,$myRegularCards);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);
        return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));
    }

    public function storeCard(Request $request)
    {
        $currentUser = auth()->user();
        $status = "succes";
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

    public function deactivateAdminCard(Request $request)
    {
        $adminCard =  Auth::User()->adminCards()->where('card_id', '=',$request->card_id)->first();
        if (empty($adminCard)) {
            return response()->json("no adminCard found");
        } else {
            $adminCard->active = false;
            $adminCard->synced_to_brainbox = false;
            $adminCard->update();
            return response()->json($request->card_id);
        }
    }
    public function deactivateCatCard(Request $request)
    {
        $catCard =  Auth::User()->cards()->where('card_id', '=',$request->card_id)->first();

        if (empty($catCard)) {
            return response()->json("no catCard found");
        } else {
            $catCard->active = false;
            $catCard->synced_to_brainbox = false;
            $catCard->update();
            return response()->json($request->card_id);
        }
    }
}

