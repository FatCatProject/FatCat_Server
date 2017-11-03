<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use DateTime;
use carboon;
use App\User;
use App\CatBreed;
use App\Cat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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

    public function catPage($id,$date='null')
    {
        if($date =="null"){
            $date = new DateTime();
            $date = $date->format('Y-m-d');
        }

        $ateDuringTheMonth = array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0,"10"=>0,"11"=>0,"12"=>0,
            "13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0,"24"=>0,
            "25"=>0,"26"=>0,"27"=>0,"28"=>0,"29"=>0,"30"=>0,"31"=>0);


        //all feeding logs for a cat in a month (by date)
        $monthlyFeedingLogs = $this->monthlyFeedingLogs($id,$date);

        //calculate all how much cat ate during each meal
        foreach ($monthlyFeedingLogs as $log){
            $logDate = explode(" ",$log->open_time);
            $logDay = intval((explode("-",$logDate[0]))[2]);
            $ateDuringTheMonth[$logDay]= $ateDuringTheMonth[$logDay]+($log->start_weight - $log->end_weight);

        }

        $dailyFeedingLogs = $this->dailyFeedingLogs($id,$date);
        $dailyMeals = array();
        foreach ($dailyFeedingLogs as $dailyLog){
            array_push($dailyMeals,$dailyLog->start_weight - $dailyLog->end_weight);
        }
        array_collapse($dailyMeals);
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


        $numberOfPages = intval(count($data)/10)+1;
        return view('pages.catPage', compact('cat'), compact('data'),
            compact('ateDuringMonth'), compact('dailyMeals'), compact('numberOfPages')) ->with('numberOfPages',$numberOfPages);
    }

    public function autocomplete(Request $request){
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%'.$breedSearch.'%')->pluck('breed_name');

        return response()->json($queries);
    }

    public function store(Request $request){
        $status="success";
        date_default_timezone_set('Asia/Jerusalem');
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
        date_default_timezone_set('Asia/Jerusalem');
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
