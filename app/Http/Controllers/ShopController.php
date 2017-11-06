<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //bellow this, methods of shoppingPage

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
        return redirect()->back();
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

    //above this, methods of shoppingPage ||| below this point, methods of shopsPage

    public function shopsPage(){
        $currentUser = auth()->user();
        $shops = $this->usersShops($currentUser->email);
        $products = $this->usersProducts($currentUser->email);
        //dd($products);
        return view('pages.shopsPage',compact('shops'),compact('products'));
    }

    public function storeShop(Request $request)
    {
        $status = "success";
        $currentUser = auth()->user();
        if ($currentUser == null || $request->shop_name == null) {
            $status = "failed, part of the input is lacking";
        } else {
            $id = DB::table('shops')->insertGetId(
                ['user_email' => $currentUser->email, 'shop_name' => $request->shop_name, 'url' => $request->url,
                    'address' => $request->address,'hours'=>$request->hours,'phone'=>$request->phone]
            );
        }
        return redirect()->back();
    }

    public function storeProduct(Request $request)
    {
        $status = "success";
        $currentUser = auth()->user();
        $isfood=0;
        if($request->is_food =="on"){
            $isfood=1;
        }
        if ($currentUser == null || $request->product_name == null || $request->price == null || $request->weight==null) {
            $status = "failed, part of the input is lacking";
        } else {
            $id = DB::table('products')->insertGetId(
                ['user_email' => $currentUser->email, 'product_name' => $request->product_name, 'weight' => $request->weight,
                    'price' => $request->price, 'is_food'=>$isfood]
            );
        }
        return redirect()->back();
    }

    public function usersProducts($user_email){
        $result =DB::table('products')->select('products.*')
            ->orderBy('id','desc')
            ->where(['user_email'=>$user_email])
            ->get();
        return $result;
    }

    public function usersShops($user_email){
        $result =DB::table('shops')->select('shops.*')
            ->orderBy('id','desc')
            ->where(['user_email'=>$user_email])
            ->get();
        return $result;
    }
}