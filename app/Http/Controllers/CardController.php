<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    public function cardsPage()
    {
        $currentUser = auth()->user();
        $myCards = $this->myCards($currentUser->email);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);
        return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));
    }

    public function storeCard(Request $request)
    {
        $currentUser = auth()->user();
        $myCards = $this->myCards($currentUser->email);
        $myFoodBoxes = $this->myFoodBoxes($currentUser->email);
        $status = "succes";
        if ($currentUser == null || $request->card_id == null || $request->card_name == null ||$request->foodbox_id == null ) {

        }


        return view('pages.cardsPage', compact('myCards'), compact('myFoodBoxes'));


    }

    public function storeAdminCard(Request $request)
    {

    }

    public function myCards($user_email)
    {
        $result = DB::table('cards')->select('cards.*')
            ->where('user_email', $user_email)
            ->orderBy('foodbox_id', 'desc')
            ->get();

        $adminCards = DB::table('admin_cards')->select('admin_cards.*')
            ->where('user_email', $user_email)
            ->orderBy('card_id', 'desc')
            ->get();

        $result = $result->concat($adminCards);
        return $result;
    }

    public function myFoodBoxes($user_email)
    {
        $result = DB::table('foodboxes')->select('foodboxes.*')
            ->where('user_email', $user_email)
            ->orderBy('foodbox_id', 'desc')
            ->get();
        return $result;
    }
}
