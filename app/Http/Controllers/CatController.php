<?php

namespace App\Http\Controllers;

use DateTime;
use App\User;
use App\CatBreed;
use App\Cat;
use App\Card;
use App\Foodbox;
use App\Http\Controllers\Auth;
use App\FeedingLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    public function catPage()
    {
//  IMPORTANT:  getting all cats and all logs - just for view checking purposes !!!
        $catInfo = Cat::all();
        $catLogs = FeedingLog::all();
        $mycats = $this->myCats();
        return view('pages.catPage', compact('catInfo'), compact('catLogs'),compact($mycats));

    }
    public function autocomplete(Request $request){
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%'.$breedSearch.'%')->pluck('breed_name');

        return response()->json($queries);
    }
    public function store(Request $request){
        $status="success";

        $currentUser = auth()->user();
        if($request->user_email == null || $request->cat_name ==null){
            $status = "failed";
        }else{
        $profile_picture=base64_encode($request->profile_picture);
        $dob = new DateTime($request->dob);
        $dob->format('Y-m-d H:i:s');
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');

        $id = DB::table('cats')->insertGetId(
            ['user_email'=>$currentUser->email ,'cat_name'=>$request->cat_name ,'profile_picture'=>$profile_picture,
                'dob'=>$dob ,'gender'=>$request->gender ,'cat_breed'=>$request->cat_breed ,
                'current_weight'=>$request->current_weight, 'target_weight'=>$request->target_weight ,
                'daily_calories'=>$request->daily_calories , 'created_at'=>$now , 'updated_at'=>$now]
        );
        }
        return redirect()->back()->with('status',$status);
    }

    //Returns all the cat names of logged in user
    public static function myCats(){
        return(auth()->user()->cats);
    }

    public function dailyEating($id,$date){
        $cat = Cat::find($id);
        $card_ids = array();
        $card_ids = DB::table('cards')->where('cat_id',$cat->id)->get();
        $dailyFeedingLogs= Array();
        foreach ($card_ids as $card_id){

            $FeedingLogs = DB::table('feeding_logs')->where(
                ['card_id',$card_id->card_id]
                ['open_time',]
            )->get();

            array_push($dailyFeedingLogs,$FeedingLogs);


        }
        return $dailyFeedingLogs;

    }


    //everything bellow is temp
    public function create1(){
        return view('temp2');
    }
    public function store1(Request $request){
        Foodbox::create($request->all());
        return redirect()->back();
    }
    public function create2(){
        return view('temp3');
    }
    public function store2(Request $request){
        Card::create($request->all());
        return redirect()->back();
    }




}
