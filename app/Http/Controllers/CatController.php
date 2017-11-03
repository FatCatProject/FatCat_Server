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

    public function catPage($id,$date='null')
    {
        //incase $date isnt passed, date = today
        if($date =="null"){
            $date = new DateTime();
            $date = $date->format('Y-m-d');
        }

        $ateDuringTheMonth = array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0,"10"=>0,"11"=>0,"12"=>0,
            "13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0,"24"=>0,
            "25"=>0,"26"=>0,"27"=>0,"28"=>0,"29"=>0,"30"=>0,"31"=>0);


        //all feeding logs for a cat in a month (by date)
        $monthlyFeedingLogs = $this->monthlyFeedingLogs($id,$date);

        $amountEatenDuringTheDay = 0;

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
        //dd($data);
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
