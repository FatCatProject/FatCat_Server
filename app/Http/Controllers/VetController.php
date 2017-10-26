<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use DateTime;
use Illuminate\Support\Facades\DB;

class VetController extends Controller
{
    public function catVetPage($id,$year='null'){
        if($year =='null'){
            $year = new DateTime();
            $year = explode('-',$year->format('Y-m-d'))[0];
        }
        $expensesPerMonth = array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,
            "9"=>0, "10"=>0,"11"=>0,"12"=>0);
        $cat = Cat::find($id);
        $currentUser = auth()->user();
        $vetLogs = $this->yearlyVetLogs($year,$cat->cat_name,$currentUser->email);
        dd($vetLogs);
        $totalExpenses = 0;
        foreach ($vetLogs as $vetLog){
            $logDate = explode(" ",$vetLog->visit_date);
            $logMonth = intval((explode("-",$logDate[0]))[1]);
            $expensesPerMonth[$logMonth]= $expensesPerMonth[$logMonth]+$vetLog->price;

        }
        //dd($allVetLogs);
        return view('pages.catVetPage',compact('cat'),compact('expensesPerMonth'))->with('vetLogs',$vetLogs);
    }

    public function store(Request $request){
        $status="success";
        $cat = Cat::find($request->id);
        date_default_timezone_set('Asia/Jerusalem');
        $currentUser = auth()->user();
        if($currentUser == null){
            $status = "Failed, you need to sign in";
        }else{
            $prescription_picture=base64_encode($request->profile_picture);
            $visit_date = (new DateTime($request->visit_date))->format('Y-m-d');
            $now = new DateTime();
            DB::table('cats_vet_logs')->insert(
                    ['user_email'=>$currentUser->email ,'visit_date'=>$visit_date ,'subject'=>$request->subject,
                        'description'=>$request->description ,'clinic_name'=>$request->clinic_name ,
                        'prescription_picture'=>$prescription_picture, 'price'=>$request->price ,
                        'cat_name'=>$cat->cat_name]
                );

        }
        return view('pages.catVetPage',['id'=>$cat->id,$year='null'],compact('cat'));
    }

    public function yearlyVetLogs($year,$name,$user_email){
        $result =DB::table('cats_vet_logs')->select('cats_vet_logs.*')
            ->whereYear('visit_date',$year)
            ->orderBy('visit_date','desc')
            ->where(['cat_name'=>$name,'user_email'=>$user_email])
            ->get();
        return $result;
    }


}
