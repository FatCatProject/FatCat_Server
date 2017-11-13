<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShoppingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ShopController extends Controller
{
    //bellow this, methods of shoppingPage

    public function shoppingPage($year = 'null')
    {
        if ($year == 'null') {
            $year = new DateTime();
            $year = explode('-', $year->format('Y-m-d'))[0];
        }
        $currentUser = auth()->user();
        $shoppingLogs = $this->yearlypurchases($year, $currentUser->email);
        $expenses_per_month = $this->expensesPerMonth($year, $currentUser->email);
        $total_expenses = $this->spentDuringYear($expenses_per_month);

        $yearly_expenses = "[";
        foreach ($expenses_per_month as $expense) {
            $yearly_expenses .= $expense . ",";
        }
        $yearly_expenses .= "]";


        return view(
            "pages.shoppingPage",
            [
                "expensesPerMonth" => $expenses_per_month,
                "shoppingLogs" => $shoppingLogs,
                "totalExpenses" => $total_expenses,
                "yearly_expenses" => $yearly_expenses
            ]
        );
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

    public function yearlypurchases($year, $user_email)
    {
        $result = DB::table('shopping_logs')->select('shopping_logs.*')
            ->whereYear('shopping_date', $year)
            ->orderBy('shopping_date', 'desc')
            ->where(['user_email' => $user_email])
            ->get();
        return $result;
    }

    public function expensesPerMonth($year, $user_email)
    {
        $expensesPerMonth = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0, "6" => 0, "7" => 0, "8" => 0,
            "9" => 0, "10" => 0, "11" => 0, "12" => 0);
        $shoppingLogs = $this->yearlypurchases($year, $user_email);
        foreach ($shoppingLogs as $log) {
            $logDate = explode(" ", $log->shopping_date);
            $logMonth = intval((explode("-", $logDate[0]))[1]);
            $expensesPerMonth[$logMonth] = $expensesPerMonth[$logMonth] + $log->price;
        }
        return $expensesPerMonth;
    }

    public function spentDuringYear($expenses)
    {
        $sum = 0;
        for ($i = 1; $i < 13; $i++) {
            $sum = $sum + $expenses[$i];
        }
        return $sum;
    }

    //above this, methods of shoppingPage ||| below this point, methods of shopsPage

    public function shopsPage()
    {
        $current_user = auth()->user();
        $shops = $this->usersShops($current_user->email);
        $products = $this->usersProducts($current_user->email);

        $products_pictures = [];

        foreach($products as $product){
            if(!empty($product->picture)){
                $picture_path = str_replace(["@", "."], "_", $current_user->email."_products")."/".$product->picture;
                if(Storage::disk("user_pictures")->exists($picture_path)){
                    $products_pictures[$product->id] = "data:image/png;base64,".base64_encode(
                            Storage::disk("user_pictures")->get($picture_path)
                        );
                }else{
                    $products_pictures[$product->id] = "No picture";
                }
            }else{
                $products_pictures[$product->id] = "No picture";
            }
        }

        return view(
            "pages.shopsPage",
            [
                "shops" => $shops,
                "products" => $products,
                "pictures" => $products_pictures

            ]
        );
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
                    'address' => $request->address, 'hours' => $request->hours, 'phone' => $request->phone]
            );
        }
        return redirect()->back();
    }

    public function storeProduct(Request $request)
    {
        $current_user = auth()->user();
        $isfood = 0;
        if ($request->is_food == "on") {
            $isfood = 1;
        }
        $product = new \App\Product(
            [
                "user_email" => $current_user->email,
                "product_name" => $request->product_name,
                "weight" => $request->weight,
                "price" => $request->price,
                "is_food" => $isfood
            ]
        );
        $check_duplicate = DB::table('products')->select('products.*')
            ->orderBy('id', 'desc')
            ->where(['user_email' => $current_user->email, 'weight' => $product->weight, 'product_name' => $product->product_name])
            ->get();

        if (count($check_duplicate) == 0) {
            $product->picture = $request->picture;
            try {
                if (!empty($request->picture)) {
                    $product->picture = str_replace(
                            ["@", "."],
                            "_",
                            $product->product_name . "_" . $product->weight
                        ) . "." . $request->picture->getClientOriginalExtension();
                }

                $product->save();
                if (!empty($product->picture)) {
                    Storage::disk("user_pictures")->putFileAs(
                        str_replace(["@", "."], "_", $current_user->email . "_products"),
                        $request->picture,
                        $product->picture
                    );
                }
            } catch (QueryException $e) {
                return response("QueryException - Fixme.\n", 400);
            }
        }else
            $status = "same product with the same name and weight already exists";
        return redirect()->back();
    }

    public function usersProducts($user_email)
    {
        $result = DB::table('products')->select('products.*')
            ->orderBy('id', 'desc')
            ->where(['user_email' => $user_email])
            ->get();
        return $result;
    }

    public function usersShops($user_email)
    {
        $result = DB::table('shops')->select('shops.*')
            ->orderBy('id', 'desc')
            ->where(['user_email' => $user_email])
            ->get();
        return $result;
    }
    //Natalie deleteShoppingLog via ajax
    public function deleteShoppingLog(Request $request)
    {
        $shopping_log =  Auth::User()->shoppingLogs()->where('id', '=',$request->id);

        if (empty($shopping_log)) {
            return response()->json("no shopping log found");
        } else {
            $shopping_log->delete();
            return response()->json($request->id);
        }
    }
//    Natalie
    public function updateShoppingLog(Request $request)
    {

        $my_shop_log =  Auth::User()->shoppingLogs()->where('id', '=',$request->id)->first();
//        return response()->json($my_shop_log);
        if (empty($my_shop_log))
            return response("shopping log not found", 204);
        $my_shop_log->shopping_date = $request->to_date;
        $my_shop_log->description = $request->to_desc;
        $my_shop_log->price = $request->to_price;

        try {
            $my_shop_log->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json([
            'newDate' => $my_shop_log->shopping_date,
            'newDesc' => $my_shop_log->description,
            'newPrice' => $my_shop_log->price
        ]);
    }
}