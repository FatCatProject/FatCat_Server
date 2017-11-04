<?php

namespace App\Http\Controllers;

use App\Cat;
use App\CatBreed;
use App\User;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use carboon;

class CatController extends Controller
{
    public function addCat()
    {
        $breeds = DB::table('cat_breeds')->pluck('breed_name');
        return view('pages.addCat', compact('breeds'));
    }

    public function breedInfo(Request $request)
    {
        if ($request->has('breed_name')) {
            $breed_name = $request->input('breed_name');

            $breed = DB::table('cat_breeds')->where('breed_name', $breed_name)->first();
            if (is_null($breed)) {
                $breed = DB::table('cat_breeds')->where('breed_name', 'Other')->first();
            }

        } else {
            $breed = DB::table('cat_breeds')->where('breed_name', 'Other')->first();
        }

        return response()->json([
            'breed_name' => $breed->breed_name,
            'link' => $breed->link,
            'description' => $breed->description
        ]);
    }

    public function catPage($id, $date=null)
    {
        if(empty($date)){
            $date = date_create("Asia/Jerusalem");
        }

        $cat = Cat::find($id);

        $ate_today = 0;
        $ate_during_month_tmp = [];
        $ate_during_month_tmp_labels = [];
        foreach($cat->cards as $card){
            $card_logs = DB::table("feeding_logs")
                ->where("user_email", $card->user_email)
                ->where("card_id", $card->card_id)
                ->whereMonth("open_time", $date->format("m"))
                ->select("feeding_logs.start_weight", "feeding_logs.end_weight", "feeding_logs.open_time")
                ->get();
            foreach($card_logs as $log){
                $ate_at_feedinglog = $log-> start_weight - $log->end_weight;
                $ate_today += $ate_at_feedinglog;

                $day_of_log = intval((new DateTime($log->open_time))->format("d"));
                $ate_during_month_tmp[$day_of_log] =
                    empty($ate_during_month_tmp[$day_of_log]) ?
                        $ate_at_feedinglog :
                        ($ate_during_month_tmp[$day_of_log] + $ate_at_feedinglog);
                array_push($ate_during_month_tmp_labels, $day_of_log);
            }
        }
        $ate_during_month_tmp_labels = array_unique($ate_during_month_tmp_labels);
        sort($ate_during_month_tmp_labels);
        $ate_during_month_labels = "[";
        foreach($ate_during_month_tmp_labels as $tmp_label){
            $ate_during_month_labels .= $tmp_label.",";
        }
        $ate_during_month_labels .= "]";
        $ate_during_month = "[";
        foreach($ate_during_month_tmp as $tmp_data){
            $ate_during_month .= $tmp_data.",";
        }
        $ate_during_month .= "]";

        $ate_today = intval(ceil($ate_today));
        $daily_consumption = [
            "ate_allowance" => (($ate_today <= $cat->food_allowance) ? $ate_today : $cat->food_allowance),
            "food_left" => (($ate_today <= $cat->food_allowance) ? ($cat->food_allowance - $ate_today) : 0),
            "over_ate" => (($ate_today <= $cat->food_allowance) ? 0 : ($ate_today - $cat->food_allowance))
        ];


        $daily_meals = [1, 3];
        $data = [
            [
                "id" => 1,
                "user_email" => "aaa@ddd.com",
                "foodbox_id" => "1233333",
                "card_id" => "123-123-123-123-123",
                "feeding_id" => "2222222",
                "open_time" => "2017-10-01 11:58:36",
                "close_time" => "2017-10-01 12:00:05",
                "start_weight" => 200,
                "end_weight" => "160",
                "diff" => "fff"
            ]
        ];
        $number_of_pages = intval(count($data)/10)+1;

        array_collapse($daily_meals);
        return view(
            "pages.catPage",
            [
                "daily_consumption" => $daily_consumption,
                "ate_during_month" => $ate_during_month,
                "ate_during_month_labels" => $ate_during_month_labels,
                "ateDuringMonth" => $ate_during_month,
                "cat" => $cat,
                "dailyMeals" => $daily_meals,
                "data" => $data,
                "numberOfPages" => $number_of_pages
            ]
        );
    }

    public function autocomplete(Request $request){
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%'.$breedSearch.'%')->pluck('breed_name');

        return response()->json($queries);
    }

    public function store(Request $request){
        $current_user = auth()->user();

        $my_cat = new \App\Cat(
            [
                "cat_name" => $request->cat_name,
                "user_email" => $current_user->email
            ]
        );

        $my_cat->cat_breed = $request->cat_breed;
        $my_cat->current_weight = $request->current_weight;
        $my_cat->daily_calories = $request->daily_calories;
        $my_cat->dob = $request->dob;
        $my_cat->gender = $request->gender;
        $my_cat->target_weight = $request->target_weight;

        try{
            if(!empty($request->profile_picture)){
                $my_cat->profile_picture = str_replace(
                    ["@", "."],
                    "_",
                    $current_user->email."_".$my_cat->cat_name
                ).".".$request->profile_picture->getClientOriginalExtension();
            }

            $my_cat->save();
            if (!empty($my_cat->profile_picture)){
                Storage::disk("user_pictures")->putFileAs(
                    str_replace(["@", "."], "_", $current_user->email),
                    $request->profile_picture,
                    $my_cat->profile_picture
                );
            }
        }catch(QueryException $e){
            return response("QueryException - Fixme.\n", 400);
        }
        return redirect()->action("CatController@catPage", ["id" => $my_cat->id]);
    }

    public function update(Request $request){
        $cat = Cat::find($request->id);
        date_default_timezone_set('Asia/Jerusalem');
        $cat->cat_name = $request->cat_name;
        if($request->has("profile_picture")){
            $cat->profile_picture = base64_encode(file_get_contents($request->file("profile_picture")->path()));
        }
        $cat->dob = $request->dob;
        $cat->gender = $request->gender;
        if(CatBreed::find($request->cat_breed)!=null){
            $cat->cat_breed = $request->cat_breed;
        }

        $cat->current_weight = $request->current_weight;
        $cat->target_weight = $request->target_weight;
        $cat->daily_calories = $request->daily_calories;

        $cat->update();
        return redirect()->back();
    }

    public function allReportsByID($id){
        $result =DB::table('feeding_logs')->select('feeding_logs.*','cards.*')
            ->join('cards','cards.card_id','=','feeding_logs.card_id')
            ->where('cards.cat_id',$id)
            ->orderBy('open_time','desc')
            ->get();
        return $result;
    }

    public function dailyFeedingLogs($id,$date){
        $result =DB::table('feeding_logs')->select('feeding_logs.*','cards.*')
            ->join('cards','cards.card_id','=','feeding_logs.card_id')
            ->where('cards.cat_id',$id)
            ->whereDate('open_time',$date)
            ->orderBy('open_time','asc')
            ->get();
        return $result;
    }

    public function monthlyFeedingLogs($id,$date){
        $dateParts = explode("-",$date);
        $year = $dateParts[0];
        $month = $dateParts[1];

        $result =DB::table('feeding_logs')->select('feeding_logs.*','cards.*')
            ->join('cards','cards.card_id','=','feeding_logs.card_id')
            ->where('cards.cat_id',$id)
            ->whereMonth('open_time',$month)
            ->whereYear('open_time',$year)
            ->orderBy('open_time','asc')
            ->get();
        return $result;
    }

    public function diffBetweenDates($openTime, $closeTime){
        $epochOpenTime = strtotime($openTime);
        $epochCloseTime = strtotime($closeTime);
        $epochDiff = $epochCloseTime - $epochOpenTime;
        $result = "";
        if($epochDiff > 3600){
            $diffHours = intval($epochDiff/3600);
            $epochDiff = $epochDiff-($diffHours*3600);
            $result = "Hours:".$diffHours;
        }
        if($epochDiff>60){
            $diffMinutes = intval($epochDiff/60);
            $epochDiff = $epochDiff-($diffMinutes*60);
            $result = $result." Minutes:".$diffMinutes;
        }

        if($epochDiff>0){
            $result = $result." Seconds:".$epochDiff;
        }
        return $result;
    }

    public function myCats(){
        $user = User::find(Auth::id());
        $cats = DB::table('cats')->where('user_email',$user->email)->get();
        return $cats;
    }

}
