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
        $allMyCats = $this->myCats();
        if(count($allMyCats)/3>intval(count($allMyCats)/3))
            $numberOfRows=intval(count($allMyCats)/3)+1;
        else
            $numberOfRows = intval(count($allMyCats))/3;

        return view('pages.addCat', compact('breeds'),compact('numberOfRows'))->with('allMyCats',$allMyCats);
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

    public function catPage($id)
    {
        $date = date_create("Asia/Jerusalem");

        $cat = Cat::find($id);

        $ate_today = 0;
        $daily_logs_tmp = [];
        $daily_logs_tmp_labels = [];
        $label_index_tmp = 0;
        $month_logs_tmp = [];
        $month_logs_tmp_labels = [];
        $days_in_month = intval(date("t", mktime(0, 0, 0, intval($date->format("m")), 1, intval($date->format("Y")))));
        for($day = 1; $day <= $days_in_month; $day++){
            $day_tmp = str_pad(strval($day), 2, "0", STR_PAD_LEFT);
            array_push($month_logs_tmp_labels, $day_tmp);
            $month_logs_tmp[$day_tmp] = 0;
        }
        $feeding_logs = [];
        foreach($cat->cards as $card){
            $card_logs = DB::table("feeding_logs")
                ->where("user_email", $card->user_email)
                ->where("card_id", $card->card_id)
                ->whereYear("open_time", $date->format("Y"))
                ->whereMonth("open_time", $date->format("m"))
                ->select(
                    "feeding_logs.start_weight", "feeding_logs.end_weight", "feeding_logs.open_time",
                    "feeding_logs.close_time"
                )
                ->get();
            foreach($card_logs as $log){
                $ate_at_feedinglog = $log-> start_weight - $log->end_weight;

                $day_of_log = (new DateTime($log->open_time))->format("d");
                $month_logs_tmp[$day_of_log] += $ate_at_feedinglog;

                array_push($feeding_logs, $log);
                if ($day_of_log == $date->format("d")){
                    $ate_today += $ate_at_feedinglog;
                    $label_index_tmp += 1;
                    array_push($daily_logs_tmp, strval($ate_at_feedinglog));
                    array_push($daily_logs_tmp_labels, strval($label_index_tmp));
                }
            }
        }

        $daily_logs_labels = "[";
        foreach($daily_logs_tmp_labels as $tmp_label){
            $daily_logs_labels .= $tmp_label.",";
        }
        $daily_logs_labels .= "]";
        $daily_logs = "[";
        foreach($daily_logs_tmp as $tmp_data){
            $daily_logs .= $tmp_data.",";
        }
      
        $daily_logs .= "]";

        $ate_today = intval(ceil($ate_today));
        $daily_consumption = [
            "ate_allowance" => (($ate_today <= $cat->food_allowance) ? $ate_today : $cat->food_allowance),
            "food_left" => (($ate_today <= $cat->food_allowance) ? ($cat->food_allowance - $ate_today) : 0),
            "over_ate" => (
                (($ate_today <= $cat->food_allowance) or ($cat->food_allowance == 0)) ?
                0 : ($ate_today - $cat->food_allowance)
            )
        ];

        $month_logs_labels = "[";
        foreach($month_logs_tmp_labels as $tmp_label){
            $month_logs_labels .= $tmp_label.",";
        }
        $month_logs_labels .= "]";
        $month_logs = "[";
        foreach($month_logs_tmp as $tmp_label){
            $month_logs .= $tmp_label.",";
        }
        $month_logs .= "]";

        $number_of_pages = intval(count($feeding_logs)/10)+1;

        return view(
            "pages.catPage",
            [
                "today" => $date,
                "daily_consumption" => $daily_consumption,
                "daily_logs" => $daily_logs,
                "daily_logs_labels" => $daily_logs_labels,
                "month_logs" => $month_logs,
                "month_logs_labels" => $month_logs_labels,
                "feeding_logs" => $feeding_logs,
                "cat" => $cat,
                "number_of_pages" => $number_of_pages
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
        $breeds = DB::table('cat_breeds')->get();
        $cats = json_decode($cats,true);
        for($i=0;$i<count($cats);$i++){
            foreach ($breeds as $breed){
                if($breed->breed_name == $cats[$i]['cat_breed']){
                    $cats[$i]['breed_link']=$breed->link;
                    break;
                }
            }
        }
        return $cats;
    }

}
