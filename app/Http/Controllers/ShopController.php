<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShoppingLog;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $current_user = auth()->user();
        $check_duplicate = DB::table('shops')->select('shops.*')
            ->where(['user_email' => $current_user->email, 'shop_name' => $request->shop_name])
            ->get();
        if ($current_user == null || $request->shop_name == null || count($check_duplicate)>0) {
            $status = "failed, part of the input is lacking";
        } else {
            $id = DB::table('shops')->insertGetId(
                ['user_email' => $current_user->email, 'shop_name' => $request->shop_name, 'url' => $request->url,
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
    public function deleteShop(Request $request)
    {
        $shop =  Auth::User()->shops()->where('id', '=',$request->id);

        if (empty($shop)) {
            return response()->json("no shop found");
        } else {
            $shop->delete();
            return response()->json($request->id);
        }
    }

    public function deleteProduct(Request $request)
    {
        $product =  Auth::User()->products()->where('id', '=',$request->id);

        if (empty($product)) {
            return response()->json("no product found");
        } else {
            $product->delete();
            return response()->json($request->id);
        }
    }
    public function updateShop(Request $request)
    {

        $my_shop =  Auth::User()->shops()->where('id', '=',$request->id)->first();
        if (empty($my_shop))
            return response("shop not found", 204);
        $my_shop->shop_name = $request->to_crr_shop_name;
        $my_shop->url = $request->to_crr_url;
        $my_shop->address = $request->to_crr_address;
        $my_shop->hours = $request->to_crr_open_hours;
        $my_shop->phone = $request->to_crr_number;
        try {
            $my_shop->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json([
            'newName' => $my_shop->shop_name,
            'newUrl' => $my_shop->url,
            'newAddress' => $my_shop->address,
            'newHours' => $my_shop->hours,
            'newPhone' => $my_shop->phone
        ]);
    }
    public function updateProduct(Request $request)
    {

        $my_product =  Auth::User()->products()->where('id', '=',$request->id)->first();
        if (empty($my_product))
            return response("product not found", 204);
        $my_product->product_name = $request->to_crr_name;
        $my_product->weight = $request->to_crr_weight;
        $my_product->price = $request->to_crr_price;
        $my_product->is_food = ($request->isFood == 1);
//        $my_product->picture = $request->pic;
        try {
            $my_product->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }
        return response()->json([
            'newName' => $my_product->product_name,
            'newWeight' => $my_product->weight,
            'newPrice' => $my_product->price,
            'newIsFood' => $my_product->is_food
        ]);
    }

    public function yearlyExpenses(Request $request){
        $current_user = Auth::User();
        $year_date = new DateTime($request->year_date."-01-01");

        $query_data = $current_user->shoppingLogs()
            ->whereYear("shopping_logs.shopping_date", $year_date->format("Y"))
            ->groupBy("month")
            ->orderBy("month")
            ->selectRaw("MONTH(shopping_logs.shopping_date) AS month, SUM(shopping_logs.price) AS sum")
            ->get();

        $response_data = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($query_data as $record){
            $response_data[($record->month - 1)] = $record->sum;
        }
        return response()->json($response_data);
    }

    public function tableData(Request $request){
        $current_user = Auth::User();
        $month_date = new DateTime($request->month_date."-01");
        $request_page = (!empty($request->page) and ($request->page > 0)) ? $request->page : 1;
        $request_entries_per_page = ((!empty($request->entries_per_page)) and ($request->entries_per_page > 0)) ?
            $request->entries_per_page : 10;

        $response_number_of_pages = ceil((
            $current_user->shoppingLogs()
            ->whereYear("shopping_logs.shopping_date", $month_date->format("Y"))
            ->whereMonth("shopping_logs.shopping_date", $month_date->format("m"))
            ->count() / $request_entries_per_page)
        );
        $request_page = $request_page < $response_number_of_pages ? $request_page : $response_number_of_pages;

        $response_shopping_logs = $current_user->shoppingLogs()
            ->whereYear("shopping_date", $month_date->format("Y"))
            ->whereMonth("shopping_date", $month_date->format("m"))
            ->orderBy("shopping_logs.shopping_date")
            ->select("shopping_logs.id", "shopping_logs.shopping_date", "shopping_logs.description", "shopping_logs.price")
            ->skip(($request_page - 1) * $request_entries_per_page)
            ->take($request_entries_per_page)
            ->get();

        return response()->json(
            [
                "number_of_pages" => strval($response_number_of_pages),
                "page_number" => strval($request_page),
                "shopping_logs" => $response_shopping_logs
            ]
        );
    }

    public function checkShopExists(Request $request)
    {
        $current_user = Auth::User();
        $exists = true;
        try {
            $current_user->shops()
                ->where("shop_name", "=", $request->shop_name)
                ->where("id", "!=", $request->shop_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $exists = false;
        }
        return response()->json(["exists" => $exists]);
    }

    public function checkProductExists(Request $request)
    {
        $current_user = Auth::User();
        $exists = true;
        try {
            $current_user->products()
                ->where("product_name", "=", $request->product_name)
                ->where("weight", "=", $request->product_weight)
                ->where("id", "!=", $request->product_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $exists = false;
        }
        return response()->json(["exists" => $exists]);
    }

}

