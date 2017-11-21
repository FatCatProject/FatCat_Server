<?php

namespace App\Http\Controllers;

use App\Cat;
use App\CatBreed;
use App\User;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use carboon;

class CatController extends Controller
{
    public function addCat(Request $request)
    {
        $breeds = DB::table('cat_breeds')->pluck('breed_name');
        $current_user = Auth::User();
        $all_my_cats = $current_user->cats;
        $allMyCats = $all_my_cats;
        if (count($allMyCats) / 3 > intval(count($allMyCats) / 3))
            $numberOfRows = intval(count($allMyCats) / 3) + 1;
        else
            $numberOfRows = intval(count($allMyCats)) / 3;

        $cat_profile_pictures = [];
        $default_profile_picture = "/images/default_cat.png";
        foreach ($allMyCats as $cat) {
            if (!empty($cat->profile_picture)) {
                $profile_picture_path = str_replace(["@", "."], "_", $current_user->email) . "/" . $cat->profile_picture;
                if (Storage::disk("user_pictures")->exists($profile_picture_path)) {
                    $cat_profile_pictures[$cat->cat_name] = "data:image/png;base64," . base64_encode(
                            Storage::disk("user_pictures")->get($profile_picture_path)
                        );
                } else {
                    $cat_profile_pictures[$cat->cat_name] = $default_profile_picture;
                }
            } else {
                $cat_profile_pictures[$cat->cat_name] = $default_profile_picture;
            }
        }
        $current_cat = Cat::find($request->cat_id);
        return view('pages.addCat', compact('breeds'), compact('numberOfRows'))->with('allMyCats', $allMyCats)->with('cat_profile_pictures', $cat_profile_pictures)->with('cat', $current_cat);
    }

    public function breedInfo(Request $request)
    {
        if ($request->has('breed_name')) {
            $breed_name = $request->input('breed_name');

            $breed = DB::table('cat_breeds')
                ->where('breed_name', $breed_name)
                ->orWhere('breed_name', $breed_name . "_cat")
                ->first();
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
        $date = date_create("Asia/Jerusalem");

        $cat = Cat::find($id);

        $ate_today = 0;
        $daily_logs_tmp = [];
        $daily_logs_tmp_labels = [];
        $label_index_tmp = 0;
        $month_logs_tmp = [];
        $month_logs_tmp_labels = [];
        $days_in_month = intval(date("t", mktime(0, 0, 0, intval($date->format("m")), 1, intval($date->format("Y")))));
        for ($day = 1; $day <= $days_in_month; $day++) {
            $day_tmp = str_pad(strval($day), 2, "0", STR_PAD_LEFT);
            array_push($month_logs_tmp_labels, $day_tmp);
            $month_logs_tmp[$day_tmp] = 0;
        }
        $feeding_logs = [];
        foreach ($cat->cards as $card) {
            $card_logs = DB::table("feeding_logs")
                ->where("user_email", $card->user_email)
                ->where("card_id", $card->card_id)
                ->whereYear("open_time", $date->format("Y"))
                ->whereMonth("open_time", $date->format("m"))
                ->select(
                    "feeding_logs.start_weight", "feeding_logs.end_weight", "feeding_logs.open_time",
                    "feeding_logs.close_time"
                )
                ->get();
            foreach ($card_logs as $log) {
                $ate_at_feedinglog = $log->start_weight - $log->end_weight;

                $day_of_log = (new DateTime($log->open_time))->format("d");
                $month_logs_tmp[$day_of_log] += $ate_at_feedinglog;

                array_push($feeding_logs, $log);
                if ($day_of_log == $date->format("d")) {
                    $ate_today += $ate_at_feedinglog;
                    $label_index_tmp += 1;
                    array_push($daily_logs_tmp, strval($ate_at_feedinglog));
                    array_push($daily_logs_tmp_labels, strval($label_index_tmp));
                }
            }
        }

        $daily_logs_labels = "[";
        foreach ($daily_logs_tmp_labels as $tmp_label) {
            $daily_logs_labels .= $tmp_label . ",";
        }
        $daily_logs_labels .= "]";
        $daily_logs = "[";
        foreach ($daily_logs_tmp as $tmp_data) {
            $daily_logs .= $tmp_data . ",";
        }

        $daily_logs .= "]";

        $ate_today = intval(ceil($ate_today));
        $daily_consumption = [
            "ate_allowance" => (($ate_today <= $cat->food_allowance) ? $ate_today : $cat->food_allowance),
            "food_left" => (($ate_today <= $cat->food_allowance) ? ($cat->food_allowance - $ate_today) : 0),
            "over_ate" => (
            (($ate_today <= $cat->food_allowance) or ($cat->food_allowance == 0)) ?
                0 : ($ate_today - $cat->food_allowance)
            )
        ];

        $month_logs_labels = "[";
        foreach ($month_logs_tmp_labels as $tmp_label) {
            $month_logs_labels .= $tmp_label . ",";
        }
        $month_logs_labels .= "]";
        $month_logs = "[";
        foreach ($month_logs_tmp as $tmp_label) {
            $month_logs .= $tmp_label . ",";
        }
        $month_logs .= "]";

        $number_of_pages = intval(count($feeding_logs) / 10) + 1;

        return view(
            "pages.catPage",
            [
                "today" => $date,
                "daily_consumption" => $daily_consumption,
                "daily_logs" => $daily_logs,
                "daily_logs_labels" => $daily_logs_labels,
                "month_logs" => $month_logs,
                "month_logs_labels" => $month_logs_labels,
                "feeding_logs" => $feeding_logs,
                "cat" => $cat,
                "number_of_pages" => $number_of_pages
            ]
        );
    }

    public function autocomplete(Request $request)
    {
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%' . $breedSearch . '%')
            ->orWhere('breed_name', 'LIKE', '%' . str_replace(' ', '_', $breedSearch) . '%')
            ->pluck('breed_name');


        return response()->json($queries);
    }

    public function store(Request $request)
    {
        $current_user = auth()->user();

        $my_cat = new \App\Cat(
            [
                "cat_name" => $request->cat_name,
                "user_email" => $current_user->email
            ]
        );

        try {
            $my_cat->cat_breed = \App\CatBreed::where("breed_name", "=", $request->cat_breed)
                ->orWhere("breed_name", "=", $request->cat_breed . "_cat")
                ->firstOrFail()
                ->breed_name;
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $my_cat->cat_breed = "other";
        }
        $my_cat->current_weight = $request->current_weight;
        $my_cat->daily_calories = $request->daily_calories;
        $my_cat->dob = $request->dob;
        $my_cat->gender = $request->gender;
        $my_cat->target_weight = $request->target_weight;
        $my_cat->food_allowance = $request->food_allowance;

        try {
            if (!empty($request->profile_picture)) {
                $my_cat->profile_picture = str_replace(
                        ["@", "."],
                        "_",
                        $current_user->email . "_" . $my_cat->cat_name
                    ) . "." . $request->profile_picture->getClientOriginalExtension();
            }

            $my_cat->save();
            if (!empty($my_cat->profile_picture)) {
                Storage::disk("user_pictures")->putFileAs(
                    str_replace(["@", "."], "_", $current_user->email),
                    $request->profile_picture,
                    $my_cat->profile_picture
                );
            }
        } catch (QueryException $e) {
            return response("QueryException - Fixme.\n", 400);
        }

        return redirect()->action("CatController@addCat");
    }

    public function update(Request $request)
    {
        $current_user = Auth::User();
        $cat = Cat::find($request->id);
        date_default_timezone_set('Asia/Jerusalem');
        $cat->cat_name = $request->cat_name;
        $cat->dob = $request->dob;
        $cat->gender = $request->gender;
        if (!empty($request->cat_breed)) {
            try {
                $cat->cat_breed = \App\CatBreed::where("breed_name", "=", $request->cat_breed)
                    ->orWhere("breed_name", "=", $request->cat_breed . "_cat")
                    ->firstOrFail()
                    ->breed_name;
            } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $cat->cat_breed = "other";
            }
        }

        $cat->current_weight = $request->current_weight;
        $cat->target_weight = $request->target_weight;
        $cat->daily_calories = $request->daily_calories;
        $cat->food_allowance = $request->food_allowance;

        if (!empty($request->profile_picture)) {
            $cat->profile_picture = str_replace(
                    ["@", "."],
                    "_",
                    $current_user->email . "_" . $cat->cat_name
                ) . "." . $request->profile_picture->getClientOriginalExtension();
        }

        if (!empty($request->profile_picture)) {
            Storage::disk("user_pictures")->putFileAs(
                str_replace(["@", "."], "_", $current_user->email),
                $request->profile_picture,
                $cat->profile_picture
            );
        }
        $cat->update();
//        return redirect()->action("CatController@catPage", ["id" => $cat->id]);
        return redirect()->back();

    }

    public function allReportsByID($id)
    {
        $result = DB::table('feeding_logs')->select('feeding_logs.*', 'cards.*')
            ->join('cards', 'cards.card_id', '=', 'feeding_logs.card_id')
            ->where('cards.cat_id', $id)
            ->orderBy('open_time', 'desc')
            ->get();
        return $result;
    }

    public function dailyFeedingLogs($id, $date)
    {
        $result = DB::table('feeding_logs')->select('feeding_logs.*', 'cards.*')
            ->join('cards', 'cards.card_id', '=', 'feeding_logs.card_id')
            ->where('cards.cat_id', $id)
            ->whereDate('open_time', $date)
            ->orderBy('open_time', 'asc')
            ->get();
        return $result;
    }

    public function monthlyFeedingLogs($id, $date)
    {
        $dateParts = explode("-", $date);
        $year = $dateParts[0];
        $month = $dateParts[1];

        $result = DB::table('feeding_logs')->select('feeding_logs.*', 'cards.*')
            ->join('cards', 'cards.card_id', '=', 'feeding_logs.card_id')
            ->where('cards.cat_id', $id)
            ->whereMonth('open_time', $month)
            ->whereYear('open_time', $year)
            ->orderBy('open_time', 'asc')
            ->get();
        return $result;
    }

    public function diffBetweenDates($openTime, $closeTime)
    {
        $epochOpenTime = strtotime($openTime);
        $epochCloseTime = strtotime($closeTime);
        $epochDiff = $epochCloseTime - $epochOpenTime;
        $result = "";
        if ($epochDiff > 3600) {
            $diffHours = intval($epochDiff / 3600);
            $epochDiff = $epochDiff - ($diffHours * 3600);
            $result = "Hours:" . $diffHours;
        }
        if ($epochDiff > 60) {
            $diffMinutes = intval($epochDiff / 60);
            $epochDiff = $epochDiff - ($diffMinutes * 60);
            $result = $result . " Minutes:" . $diffMinutes;
        }

        if ($epochDiff > 0) {
            $result = $result . " Seconds:" . $epochDiff;
        }
        return $result;
    }

    public function myCats()
    {
        $user = User::find(Auth::id());
        $cats = DB::table('cats')->where('user_email', $user->email)->get();
        $breeds = DB::table('cat_breeds')->get();
        $cats = json_decode($cats, true);
        for ($i = 0; $i < count($cats); $i++) {
            foreach ($breeds as $breed) {
                if ($breed->breed_name == $cats[$i]['cat_breed']) {
                    $cats[$i]['breed_link'] = $breed->link;
                    break;
                }
            }
        }
        return $cats;
    }

    public function myBoxes()
    {
        $user = User::find(Auth::id());
        $boxes = DB::table('foodboxes')->where('user_email', $user->email)->get();
        $boxes = json_decode($boxes, true);
        return $boxes;
    }

    public function editCat($id)
    {
        $cat = Cat::find($id);
        return view(
            "layouts.catFields",
            ["cat" => $cat,]
        );
    }

    public function dailyConsumption(Request $request)
    {
        $current_user = Auth::User();
        $day_date = new DateTime($request->day_date);
        $request_cat = $current_user->cats()->find($request->cat_id);

        if (empty($request_cat)) {
            return response()->json("", 403);
        }
        $ate_today = \DB::table("cards")
                ->join("feeding_logs", "cards.card_id", "=", "feeding_logs.card_id")
                ->where("cards.user_email", "=", $current_user->email)
                ->where("feeding_logs.user_email", "=", $current_user->email)
                ->where("cards.cat_id", "=", $request_cat->id)
                ->whereDate("feeding_logs.open_time", $day_date->format("Y-m-d"))
                ->selectRaw("SUM(feeding_logs.start_weight - feeding_logs.end_weight) AS sum")->first()->sum ?? 0;

        $daily_consumption = [
            "ate_allowance" => (
            ($ate_today <= $request_cat->food_allowance) ? $ate_today : $request_cat->food_allowance
            ),
            "food_left" => (
            ($ate_today <= $request_cat->food_allowance) ? ($request_cat->food_allowance - $ate_today) : 0
            ),
            "over_ate" => (
            (($ate_today <= $request_cat->food_allowance) or ($request_cat->food_allowance == 0)) ?
                0 : ($ate_today - $request_cat->food_allowance)
            )
        ];

        return response()->json($daily_consumption);
    }

    public function dailyLogs(Request $request)
    {
        $current_user = Auth::User();
        $day_date = new DateTime($request->day_date);
        $request_cat = $current_user->cats()->find($request->cat_id);

        if (empty($request_cat)) {
            return response()->json("", 403);
        }

        $daily_logs = \DB::table("cards")
            ->join("feeding_logs", "cards.card_id", "=", "feeding_logs.card_id")
            ->where("cards.user_email", "=", $current_user->email)
            ->where("feeding_logs.user_email", "=", $current_user->email)
            ->where("cards.cat_id", "=", $request_cat->id)
            ->whereDate("feeding_logs.open_time", $day_date->format("Y-m-d"))
            ->groupBy("feeding_logs.feeding_id")
            ->orderBy("feeding_logs.open_time")
            ->selectRaw("SUM(feeding_logs.start_weight - feeding_logs.end_weight) AS sum");

        return response()->json($daily_logs->pluck("sum"));
    }

    public function monthyLogs(Request $request)
    {
        $current_user = Auth::User();
        $month_date = new DateTime($request->month_date . "-01");
        $request_cat = $current_user->cats()->find($request->cat_id);

        if (empty($request_cat)) {
            return response()->json("", 403);
        }

        $monthly_logs_query_data = \DB::table("cards")
            ->join("feeding_logs", "cards.card_id", "=", "feeding_logs.card_id")
            ->where("cards.user_email", "=", $current_user->email)
            ->where("feeding_logs.user_email", "=", $current_user->email)
            ->where("cards.cat_id", "=", $request_cat->id)
            ->whereYear("feeding_logs.open_time", $month_date->format("Y"))
            ->whereMonth("feeding_logs.open_time", $month_date->format("m"))
            ->groupBy("day")
            ->orderBy("day")
            ->selectRaw("DAY(feeding_logs.open_time) as day, SUM(feeding_logs.start_weight - feeding_logs.end_weight) AS total")
            ->get();

        $days_in_month = intval(
            date("t", mktime(0, 0, 0, intval($month_date->format("m")), 1, intval($month_date->format("Y"))))
        );
        $monthly_logs_response = [];
        for ($day = 0; $day < $days_in_month; $day++) {
            $monthly_logs_response[$day] = 0;
        }
        foreach ($monthly_logs_query_data as $row) {
            $monthly_logs_response[$row->day - 1] = $row->total;
        }

        return response()->json($monthly_logs_response);
    }

    public function tableLogs(Request $request)
    {
        $current_user = Auth::User();
        $month_date = new DateTime($request->month_date . "-01");
        $request_cat = $current_user->cats()->find($request->cat_id);
        $request_page = (!empty($request->page) and ($request->page > 0)) ? $request->page : 1;
        $request_entries_per_page = ((!empty($request->entries_per_page)) and ($request->entries_per_page > 0)) ?
            $request->entries_per_page : 10;

        if (empty($request_cat)) {
            return response()->json("", 403);
        }

        $response_number_of_pages = ceil((\DB::table("cards")
                ->join("feeding_logs", "cards.card_id", "=", "feeding_logs.card_id")
                ->where("cards.user_email", "=", $current_user->email)
                ->where("feeding_logs.user_email", "=", $current_user->email)
                ->where("cards.cat_id", "=", $request_cat->id)
                ->whereYear("feeding_logs.open_time", $month_date->format("Y"))
                ->whereMonth("feeding_logs.open_time", $month_date->format("m"))
                ->count()) / $request_entries_per_page);

        $request_page = $request_page < $response_number_of_pages ? $request_page : $response_number_of_pages;

        $response_feeding_logs = \DB::table("cards")
            ->join("feeding_logs", "cards.card_id", "=", "feeding_logs.card_id")
            ->where("cards.user_email", "=", $current_user->email)
            ->where("feeding_logs.user_email", "=", $current_user->email)
            ->where("cards.cat_id", "=", $request_cat->id)
            ->whereYear("feeding_logs.open_time", $month_date->format("Y"))
            ->whereMonth("feeding_logs.open_time", $month_date->format("m"))
            ->orderBy("feeding_logs.open_time")
            ->select(
                "feeding_logs.start_weight", "feeding_logs.end_weight", "feeding_logs.open_time",
                "feeding_logs.close_time"
            )
            ->skip(($request_page - 1) * $request_entries_per_page)
            ->take($request_entries_per_page)
            ->get();

        return response()->json(
            [
                "number_of_pages" => strval($response_number_of_pages),
                "page_number" => strval($request_page),
                "feeding_logs" => $response_feeding_logs
            ]
        );
    }

    public function boxManagePage()
    {
        $user = User::find(Auth::id());
        $boxes = $user->foodboxes;
        $foods = $user->foods;
        $my_cats = $user->cats;
        if (count($boxes) / 3 > intval(count($boxes) / 3))
            $numberOfRows = intval(count($boxes) / 3) + 1;
        else
            $numberOfRows = intval(count($boxes)) / 3;
        $foodbox_data = [];
        foreach ($user->foodboxes as $foodbox) {

            $foodbox_cat = $foodbox->cards()->where("active", "=", 1)->first()->cat ?? (object)["cat_name" => "No active card"];

            $foodbox_cat_profile_picture = "/images/default_cat.png";
            if (!empty($foodbox_cat->profile_picture)) {
                $profile_picture_path = str_replace(["@", "."], "_", $user->email) . "/" . $foodbox_cat->profile_picture;
                if (Storage::disk("user_pictures")->exists($profile_picture_path)) {
                    $foodbox_cat_profile_picture = "data:image/png;base64," . base64_encode(
                            Storage::disk("user_pictures")->get($profile_picture_path)
                        );
                }
            }
            if ($foodbox->food == null) {
                array_push(
                    $foodbox_data,
                    [
                        "id" => $foodbox->id,
                        "foodbox_id" => $foodbox->foodbox_id,
                        "foodbox_name" => $foodbox->foodbox_name,
                        "food_name" => "no food found",
                        "current_weight" => $foodbox->current_weight,
                        "profile_picture" => $foodbox_cat_profile_picture,
                        "cat_name" => $foodbox_cat->cat_name

                    ]
                );
            } else {
                array_push(
                    $foodbox_data,
                    [
                        "id" => $foodbox->id,
                        "foodbox_id" => $foodbox->foodbox_id,
                        "foodbox_name" => $foodbox->foodbox_name,
                        "food_name" => $foodbox->food->food_name,
                        "current_weight" => $foodbox->current_weight,
                        "profile_picture" => $foodbox_cat_profile_picture,
                        "cat_name" => $foodbox_cat->cat_name

                    ]
                );
            }
        }
        return view('pages.boxManagePage', compact('numberOfRows', 'foodbox_data', 'foods', 'my_cats'));
    }

    //    Natalie
    public function updateBox(Request $request)
    {
        $currentUser = Auth::User();
        $my_box = $currentUser->foodboxes()->where('id', $request->id)->first();

        if (empty($my_box))
            return response("foodbox not found", 204);

        $my_box->foodbox_name = $request->new_box_name;
        if ($request->new_food_id == "none") {
            $my_box->food_id = null;
        } else {
            $my_box->food_id = $request->new_food_id;
        }

        try {
            $my_box->update();
        } catch (QueryException $e) {
            return response("Update failed", 500);
        }

        if ($my_box->food_id != null) {
            $new_food_name = $my_box->food->food_name;
        } else {
            $new_food_name = "no food found";
        }

        return response()->json(
            [
                'new_box_name' => $my_box->foodbox_name,
                'new_food_name' => $new_food_name,
            ]
        );
    }

    public function checkCatExists(Request $request)
    {
        $current_user = Auth::User();
        $exists = true;
        try {
            $current_user->cats()
                ->where("cat_name", "=", $request->cat_name)
                ->where("id", "!=", $request->cat_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $exists = false;
        }
        return response()->json(["exists" => $exists]);
    }

    public function deleteCat(Request $request)
    {
        $cat = Auth::User()->cats()->where('id', '=', $request->id);

        if (empty($cat)) {
            return response()->json("cat not found");
        } else {
            $cat->delete();
            return response()->json($request->id);
        }
    }
}

