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
    public function updateCatCard(Request $request)
    {

        $my_card =  Auth::User()->cards()->where('card_id', '=',$request->id_old)->first();
        if (empty($my_card))
            return response("cat card not found", 204);
        $my_card->foodbox_id = $request->to_opens;
        $my_card->card_id = $request->id_new;
        $my_card->card_name = $request->to_card_name;
        $my_card->active = $request->isActive;
        $my_card->synced_to_brainbox = false;
        $my_card->cat_id = $request->to_belongs_to;

        try {
            $my_card->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json([
            'newCardID' => $my_card->card_id,
            'newName' => $my_card->card_name,
            'newBelongsTo' => $my_card->cat_id,
            'newOpens' => $my_card->foodbox_id,
            'newActive' => $my_card->active
        ]);
    }
    public function updateAdminCard(Request $request)
    {

        $my_card =  Auth::User()->adminCards()->where('card_id', '=',$request->id_old)->first();
        if (empty($my_card))
            return response("cat card not found", 204);
        $my_card->card_id = $request->id_new;
        $my_card->card_name = $request->to_card_name;
        $my_card->active = $request->isActive;
        $my_card->synced_to_brainbox = false;

        try {
            $my_card->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json([
            'newCardID' => $my_card->card_id,
            'newName' => $my_card->card_name,
            'newActive' => $my_card->active
        ]);
    }

    public function cardsTableData(Request $request){
        $current_user = Auth::User();
        $response_cards = [];

        foreach($current_user->adminCards as $admin_card){
            array_push(
                $response_cards,
                [
                    "active" => ($admin_card->active == 1),
                    "card_id" => $admin_card->card_id,
                    "card_name" => $admin_card->card_name,
                    "cat_id" => null,
                    "cat_name" => null,
                    "foodbox_id" => null,
                    "foodbox_name" => null,
                    "is_admin" => true
                ]
            );
        }

        foreach($current_user->cards as $card){
            array_push(
                $response_cards,
                [
                    "active" => ($card->active == 1),
                    "card_id" => $card->card_id,
                    "card_name" => $card->card_name,
                    "cat_id" => $card->cat_id,
                    "cat_name" => $card->cat->cat_name,
                    "foodbox_id" => $card->foodbox_id,
                    "foodbox_name" => $card->foodbox->foodbox_name,
                    "is_admin" => false
                ]
            );
        }

        usort($response_cards, function($a, $b){ return strcmp($a['card_id'], $b['card_id']); });
        return response()->json($response_cards);
    }
}

