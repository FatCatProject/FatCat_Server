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

    public function yearlyExpenses(Request $request){
        $year = new \DateTime(
            empty($request->year) ? null : $request->year."-01-01"
        );
        $current_user = Auth::User();
        $vet_logs_query_data = \DB::table("cats_vet_logs")
            ->where("cats_vet_logs.user_email", "=", $current_user->email)
            ->whereYear("cats_vet_logs.visit_date", $year->format("Y"))
            ->groupBy("month")
            ->selectRaw("MONTH(cats_vet_logs.visit_date) AS month, SUM(cats_vet_logs.price) AS total");
        $shopping_logs_query_data = \DB::table("shopping_logs")
            ->where("shopping_logs.user_email", "=", $current_user->email)
            ->whereYear("shopping_logs.shopping_date", $year->format("Y"))
            ->groupBy("month")
            ->selectRaw("MONTH(shopping_logs.shopping_date) AS month, SUM(shopping_logs.price) AS total");
        $query_data = $vet_logs_query_data->unionAll($shopping_logs_query_data)->get();

        $response_data = [];
        for($month = 0; $month < 12; $month++){
            $response_data[$month] = 0;
        }
        foreach($query_data as $row){
            $response_data[$row->month] += $row->total;
        }
        return response()->json($response_data);
    }

    public function yearlyVetVisits(Request $request){
        $year = new \DateTime(
            empty($request->year) ? null : $request->year."-01-01"
        );
        $current_user = Auth::User();
        $query_data = \DB::table("cats_vet_logs")
            ->where("cats_vet_logs.user_email", "=", $current_user->email)
            ->whereYear("cats_vet_logs.visit_date", $year->format("Y"))
            ->groupBy("cats_vet_logs.cat_name")
            ->selectRaw("cats_vet_logs.cat_name, COUNT(*) AS visits");

        return response()->json($query_data->get());
    }
}
