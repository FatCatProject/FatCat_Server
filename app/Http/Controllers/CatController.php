<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use DateTime;
use carboon;
use App\User;
use App\CatBreed;
use App\Cat;
use App\FeedingLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Console\Presets\Vue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;

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

    public function catPage($id,$date='null')
    {
        //incase $date isnt passed, date = today
        if($date =="null"){
            $date = new DateTime();
            $date = $date->format('Y-m-d');
        }
        //all feeding logs for a cat in a single day (by date)
        $feedingLogsByDate = $this->dailyFeedingLogs($id,$date);
        $ateDuringDay = array();

        //calculate all how much cat ate during each meal
        foreach ($feedingLogsByDate as $dailyLog){
            array_push($ateDuringDay,$dailyLog->start_weight - $dailyLog->end_weight);
        }
        array_collapse($ateDuringDay);

        $cat = Cat::find($id); // used for catname

        //all logs which are displayed at the lower half of catPage
        $feedingLogs = $this->allReportsByID($id);
        $data = array();
        foreach ($feedingLogs as $log){
            $diff = $this->diffBetweenDates($log->open_time,$log->close_time);
            $improvedLog = array("id"=>$log->id,"user_email"=>$log->user_email,"foodbox_id"=>$log->foodbox_id,
                "card_id"=>$log->card_id, "feeding_id"=>$log->feeding_id, "open_time"=>$log->open_time,
                "close_time"=>$log->close_time, "start_weight"=>$log->start_weight,"end_weight"=>$log->end_weight,
                "diff"=>$diff);
            array_push($data,$improvedLog);
        }

        //number of pages that for 10 logs == 1 page
        $numberOfPages = intval(count($data)/10)+1;
        //dd($ateDuringDay);
        return view('pages.catPage', compact('cat'), compact('data'),
            compact('numberOfPages'),compact('ateDuringDay'));
    }

    public function catVetPage(){
        return view('pages.catVetPage');
    }

    public function autocomplete(Request $request){
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%'.$breedSearch.'%')->pluck('breed_name');

        return response()->json($queries);
    }

    public function storeVetEntry(Request $request){

    }

    public function store(Request $request){
        $status="success";
        $currentUser = auth()->user();
        if($request->cat_name ==null){
            $status = "failed, no input for cat name";
        }else{
            $breed = DB::table('cat_breeds')->where('breed_name',$request->cat_breed)->get();
            if(count($breed)==1){
            $profile_picture=base64_encode($request->profile_picture);
            $dob = (new DateTime($request->dob))->format('Y-m-d');
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $id = DB::table('cats')->insertGetId(
                ['user_email'=>$currentUser->email ,'cat_name'=>$request->cat_name ,'profile_picture'=>$profile_picture,
                    'dob'=>$dob ,'gender'=>$request->gender ,'cat_breed'=>$request->cat_breed , 'current_weight'=>$request->current_weight,
                    'target_weight'=>$request->target_weight , 'daily_calories'=>$request->daily_calories , 'created_at'=>$now ,
                    'updated_at'=>$now]
            );
            }else{
                $status = "failed, cat breed wasmt selected properly";
            }
        }
        return view('pages.addCat');
    }

    public function update(Request $request){
        $cat = Cat::find($request->id);
        $cat->cat_name = $request->cat_name;
        if($request->profile_picture != null){
            $cat->profile_picture = $request->profile_picture;
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

    #TO DO sort all Feeding logs by date
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
            ->orderBy('open_time','desc')
            ->get();
        return $result;
    }

    public function stringToDate($string){
        $dateString = explode(" ",$string);
        $temp = $dateString[0];

        $dateParts = explode("-",$temp);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];
        $tz='Asia/Jerusalem';//time zone
        $dateTime = Carbon::createFromDate($year, $month, $day, $tz);
        $date = $dateTime->format('Y-m-d');

        return $date;
    }

    //Not is use yet, might be needed soon
    /*
    public function stringToDateTime($string){
        $dateString = explode(" ",$string);


        $dateParts = explode("-",$dateString[0]);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];

        $timeParts = explode(":",$dateString[1]);
        $hour = $timeParts[0];
        $minute = $timeParts[1];
        $second = $timeParts[2];

        $tz='Asia/Jerusalem';//time zone

        $dateTime = Carbon::create($year, $month, $day, $hour, $minute,$second, 'Asia/Jerusalem'	);
        $date = $dateTime->format('Y-m-d H:i:s');
        dd($date);
        return $date;
    }
    */
    public function diffBetweenDates($openTime, $closeTime){
        $dateString = explode(" ",$openTime);

        $date_OpenTime = explode("-",$dateString[0]);
        $year_OpenTime = $date_OpenTime[0];
        $month_OpenTime = $date_OpenTime[1];
        $day_OpenTime = $date_OpenTime[2];

        $time_OpenTime = explode(":",$dateString[1]);
        $hour_OpenTime = $time_OpenTime[0];
        $minute_OpenTime = $time_OpenTime[1];
        $second_OpenTime = $time_OpenTime[2];

        $dateString = explode(" ",$closeTime);


        $date_CloseTime = explode("-",$dateString[0]);
        $year_CloseTime = $date_CloseTime[0];
        $month_CloseTime = $date_CloseTime[1];
        $day_CloseTime = $date_CloseTime[2];

        $time_CloseTime = explode(":",$dateString[1]);
        $hour_CloseTime = $time_CloseTime[0];
        $minute_CloseTime = $time_CloseTime[1];
        $second_CloseTime = $time_CloseTime[2];

        $diff = "";
        $diffYear = $year_CloseTime- $year_OpenTime;
        $diffMonth = $month_CloseTime - $month_OpenTime;
        $diffDay = $day_CloseTime - $day_OpenTime;
        $diffHour = $hour_CloseTime - $hour_OpenTime;
        $diffMinute = $minute_CloseTime - $minute_OpenTime;
        $diffSecond = $second_CloseTime - $second_OpenTime;

        if($diffYear > 0){
            if($diffYear == 1){
                $diff = $diff . $diffYear . "year ";
            }else{
                $diff = $diff . $diffYear . "years ";
            }
        }
        if($diffMonth > 0){
            if($diffMonth == 1){
                $diff = $diff . $diffMonth . " month ";
            }else{
                $diff = $diff . $diffMonth . " months ";
            }
        }
        if($diffDay > 0){
            if($diffDay == 1){
                $diff = $diff . $diffDay . " day ";
            }else{
                $diff = $diff . $diffDay . " days ";
            }
        }
        if($diffHour > 0){
            if($diffHour == 1){
                $diff = $diff . $diffHour . " hour ";
            }else{
                $diff = $diff . $diffHour . " hours ";
            }
        }
        if($diffMinute > 0){
            if($diffYear == 1){
                $diff = $diff . $diffMinute . " minute ";
            }else{
                $diff = $diff . $diffMinute . " minutes ";
            }
        }
        if($diffSecond > 0){
            $diff = $diff . $diffSecond . " seconds";
        }
        if($diff==""){
            return "FoodBox didnt open";
        }

        return $diff;

    }

    public function myCats(){
        $user = User::find(Auth::id());
        $cats = DB::table('cats')->where('user_email',$user->email)->get();
        return $cats;
    }

    public function test(){
        //$feedingLogs = DB::table('feeding_logs')->orderBy('open_time','desc')->get();
        //return $feedingLogs;

        /*$feedingLogs = DB::table('feeding_logs')
            ->join('feeding_logs','card.id','=','feeding_logs.card_id')
            ->join('cards','card.id','=','cards.card_id')
            ->select('feedinglogs.*','cards.*')
            ->get();
        dd($feedingLogs);
        */
        dd(DB::table('feeding_logs')->select('feeding_logs.*','cards.*')->join('cards','cards.card_id','=','feeding_logs.card_id')->orderBy('open_time','desc')->get());


    }

}
