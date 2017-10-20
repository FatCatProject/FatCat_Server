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

    public function catPage($id)
    {
//  IMPORTANT:  getting all cats and all logs - just for view checking purposes !!!
        $cat = Cat::find($id);
        $feedingLogs = $this->allReportsByID($id);
        //$timeDiffrence = array();
        $data = array();
        foreach ($feedingLogs as $log){
            $diff = $this->diffBetweenDates($log->open_time,$log->close_time);
            $improvedLog = array("id"=>$log->id,"user_email"=>$log->user_email,"foodbox_id"=>$log->foodbox_id,
                "card_id"=>$log->card_id, "feeding_id"=>$log->feeding_id, "open_time"=>$log->open_time,
                "close_time"=>$log->close_time, "start_weight"=>$log->start_weight,"end_weight"=>$log->end_weight,
                "diff"=>$diff);
            array_push($data,$improvedLog);
        }
        $numberOfPages = intval(count($data)/10)+1;
        return view('pages.catPage', compact('cat'), compact('data'),compact('numberOfPages'));
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

    public function requestFromCatFields(Request $request){
        if(strpos($_SERVER['HTTP_REFERER'],"addCat")==true){
            $this->store($request);
        }else{
        return "action not found";
        }
    }

    public function store(Request $request){
        $status="success";
        $currentUser = auth()->user();
        if($request->cat_name ==null){
            $status = "failed";
        }else{
            $profile_picture=base64_encode($request->profile_picture);
            $dob = new DateTime($request->dob);
            $dob->format('Y-d-m');
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $id = DB::table('cats')->insertGetId(
                ['user_email'=>$currentUser->email ,'cat_name'=>$request->cat_name ,'profile_picture'=>$profile_picture,
                    'dob'=>$dob ,'gender'=>$request->gender ,'cat_breed'=>$request->cat_breed , 'current_weight'=>$request->current_weight,
                    'target_weight'=>$request->target_weight , 'daily_calories'=>$request->daily_calories , 'created_at'=>$now ,
                    'updated_at'=>$now]
            );
        }


        //return view('pages.addCat',compact('status'));
        //return redirect('http://127.0.0.1:8000/addCat');
        return view('pages.addCat');
    }

    #TO DO sort all Feeding logs by date
    public function allReportsByID($id){
        $cat = Cat::find($id);
        $card_ids = array();
        $card_ids = DB::table('cards')->where('cat_id',$cat->id)->get();
        $allFeedingLogs= Array();
        foreach ($card_ids as $card_id){
            $FeedingLogs = DB::table('feeding_logs')->where('card_id',$card_id->card_id)->get();
            array_push($allFeedingLogs,$FeedingLogs);
        }
        $result = array_collapse($allFeedingLogs);
        return $result;
    }

    public function dailyFeedingLogs($id,$date){
        $allFeedingLogs = $this->allReportsByID($id);

        $todayFeedingLogs = Array();
        if($date == null){
            $date = new DateTime();
            $date->format('Y-m-d');
        }
        foreach ($allFeedingLogs as $feedingLog){
            $openTime = $feedingLog->open_time;
            $date = $this->stringToDate($openTime);
            dd($date);

            $openTime = format('Y-m-d');
            dd($openTime);
            if($openTime->format("Y-m-d") == $date->format("Y-m-d")){
                array_push($todayFeedingLogs,$feedingLog);
            }
        }
        dd($todayFeedingLogs);
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

}
