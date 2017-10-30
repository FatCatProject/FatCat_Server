<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function shoppingPage($year='null')
    {
        if($year =='null'){
            $year = new DateTime();
            $year = explode('-',$year->format('Y-m-d'))[0];
        }

        $currentUser = auth()->user();
        $shoppingLogs = $this->yearlypurchases($year,$currentUser->email);
        $expensesPerMonth = $this->expensesPerMonth($year,$currentUser->email);
        $totalExpenses = $this->spentDuringYear($expensesPerMonth);

        return view('pages.shoppingPage',compact('expensesPerMonth'),compact('shoppingLogs'))->with('totalExpenses',$totalExpenses);
    }

    public function storeShopLog(Request $request)
    {
        $status = "success";
        date_default_timezone_set('Asia/Jerusalem');
        $currentUser = auth()->user();
        if ($currentUser == null || $request->shopping_date == null || $request->price == null) {
            $status = "failed, part of the input is lacking";
        } else {
            $shopping_date = (new DateTime($request->shopping_date))->format('Y-m-d');
            $id = DB::table('shopping_logs')->insertGetId(
                ['user_email' => $currentUser->email, 'shopping_date' => $shopping_date, 'description' => $request->description,
                    'price' => $request->price]
            );
        }

        $year = new DateTime();
        $year = explode('-',$year->format('Y-m-d'))[0];
        $shoppingLogs = $this->yearlypurchases($year,$currentUser->email);
        $expensesPerMonth = $this->expensesPerMonth($year,$currentUser->email);
        $totalExpenses = $this->spentDuringYear($expensesPerMonth);

        return view('pages.shoppingPage',compact('expensesPerMonth'),compact('shoppingLogs'))->with('totalExpenses',$totalExpenses);
    }

    public function yearlypurchases($year,$user_email){
        $result =DB::table('shopping_logs')->select('shopping_logs.*')
            ->whereYear('shopping_date',$year)
            ->orderBy('shopping_date','desc')
            ->where(['user_email'=>$user_email])
            ->get();
        return $result;
    }

    public function expensesPerMonth($year,$user_email){
        $expensesPerMonth = array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,
            "9"=>0, "10"=>0,"11"=>0,"12"=>0);
        $shoppingLogs = $this->yearlypurchases($year,$user_email);
        foreach ($shoppingLogs as $log){
            $logDate = explode(" ",$log->shopping_date);
            $logMonth = intval((explode("-",$logDate[0]))[1]);
            $expensesPerMonth[$logMonth]= $expensesPerMonth[$logMonth]+$log->price;
        }
        return $expensesPerMonth;
    }

    public function spentDuringYear($expenses){
        $sum = 0;
        for($i=1;$i<13;$i++){
            $sum=$sum+$expenses[$i];
        }
        return $sum;
    }
}