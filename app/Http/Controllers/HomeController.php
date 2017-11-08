<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function homePage()
    {
        $cats = \App::call('App\Http\Controllers\CatController@myCats');
        if (count($cats) / 3 > intval(count($cats) / 3))
            $numberOfRows = intval(count($cats) / 3) + 1;
        else
            $numberOfRows = intval(count($cats)) / 3;

        return view('pages.homePage', compact('numberOfRows'), compact('cats'));
    }

    public function monthlyRatio(Request $request)
    {
        $date = new \DateTime($request->date);
        $current_user = Auth::user();
        $response_data = [];
        $query_data = \DB::table("feeding_logs")
            ->join("cards", "cards.card_id", "=", "feeding_logs.card_id")
            ->join("cats", "cats.id", "=", "cards.cat_id")
            ->where("cats.user_email", "=", $current_user->email)
            ->whereYear("feeding_logs.open_time", $date->format("Y"))
            ->whereMonth("feeding_logs.open_time", $date->format("m"))
            ->groupBy("cats.cat_name")
            ->select("cats.cat_name", \DB::raw("SUM(feeding_logs.start_weight - feeding_logs.end_weight) AS eaten"))
            ->get();

        return response()->json($query_data);
    }

}
