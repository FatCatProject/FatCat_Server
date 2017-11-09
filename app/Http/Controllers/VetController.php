<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\CatVetLog;
use Illuminate\Http\Request;
use App\Cat;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class VetController extends Controller
{
    public function catVetPage($id, $year = 'null')
    {
        if ($year == 'null') {
            $year = new DateTime();
            $year = explode('-', $year->format('Y-m-d'))[0];
        }

        $cat = Cat::find($id);
        $current_user = auth()->user();

        $vet_logs = $this->yearlyVetLogs($year, $cat->cat_name, $current_user->email);
        $expenses_per_month = $this->expensesPerMonth($vet_logs);
        $month_expenses = "[";
        foreach ($expenses_per_month as $expense){
            $month_expenses .= $expense.",";
        }
        $month_expenses .= "]";
        $total_expenses = $this->spentDuringYear($expenses_per_month);

        $vet_prescription_pictures = [];

        foreach($vet_logs as $log){
            if(!empty($log->prescription_picture)){
                $prescription_picture_path = str_replace(["@", "."], "_", $current_user->email)."/".$log->prescription_picture;
                if(Storage::disk("user_pictures")->exists($prescription_picture_path)){
                    $vet_prescription_pictures[$log->id] = "data:image/png;base64,".base64_encode(
                            Storage::disk("user_pictures")->get($prescription_picture_path)
                        );
                }else{
                    $vet_prescription_pictures[$log->id] = "No prescription picture";
                }
            }else{
                $vet_prescription_pictures[$log->id] = "No prescription picture";
            }
        }
        return view(
            "pages.catVetPage",
            [
                "cat" => $cat,
                "expensesPerMonth" => $expenses_per_month,
                "vet_logs" => $vet_logs,
                "totalExpenses" => $total_expenses,
                "vet_prescription_pictures" => $vet_prescription_pictures,
                "month_expenses" => $month_expenses
            ]
        );
    }

    public function store(Request $request)
    {
        $current_user = auth()->user();
        $vet_log = new \App\CatVetLog(
            [
                "user_email" => $current_user->email,
                "cat_name" =>  Cat::find($request->id)->cat_name,
                "visit_date" =>$request->date
            ]
        );
        $vet_log->subject = $request->subject;
        $vet_log->description = $request->description;
        $vet_log->clinic_name = $request->clinic_name;
        $vet_log->prescription_picture = $request->prescription_picture;
        $vet_log->price = $request->price;
        try{
            if(!empty($request->prescription_picture)){
                $vet_log->prescription_picture = str_replace(
                        ["@", "."],
                        "_",
                        $current_user->email."_".$vet_log->visit_date
                    ).".".$request->prescription_picture->getClientOriginalExtension();
            }

            $vet_log->save();
            if (!empty($vet_log->prescription_picture)){
                Storage::disk("user_pictures")->putFileAs(
                    str_replace(["@", "."], "_", $current_user->email),
                    $request->prescription_picture,
                    $vet_log->prescription_picture
                );
            }
        }catch(QueryException $e){
            return response("QueryException - Fixme.\n", 400);
        }
        return redirect()->back();
    }

    //update method does not remove old image file from storage
    //fixme
    public function update(Request $request){
        $current_user = auth()->user();
        date_default_timezone_set('Asia/Jerusalem');
        $vet_log = CatVetLog::find($request->to_logID);

        if($vet_log == null)
            return response()->json("Vet log not found");

        if($request->to_date == null){
            return response()->json("Visit date cannot be null");
        }else{
            $vet_log->visit_date = $request->to_date;
        }

        $vet_log->visit_date = $request->to_date;
        $vet_log->subject = $request->to_subject;
        $vet_log->description = $request->to_desc;
        $vet_log->clinic_name = $request->to_clinic;
        $vet_log->price = $request->to_price;

//        $vet_log->prescription_picture = $request->prescription_picture;
//        try{
//            if(!empty($request->prescription_picture)){
//                $vet_log->prescription_picture = str_replace(
//                        ["@", "."],
//                        "_",
//                        $current_user->email."_".$vet_log->visit_date
//                    ).".".$request->prescription_picture->getClientOriginalExtension();
//            }
//
//            $vet_log->save();
//            if (!empty($vet_log->prescription_picture)){
//                Storage::disk("user_pictures")->putFileAs(
//                    str_replace(["@", "."], "_", $current_user->email),
//                    $request->prescription_picture,
//                    $vet_log->prescription_picture
//                );
//            }
//        }catch(QueryException $e){
//            return response()->json("update failed");
//        }
        $vet_log->update();
//        return redirect()->json(["id" => $request->to_logID]);
        return redirect()->back();

    }

    //delete method does not remove image file from storage
    //fixme
    public function delete(Request $request){
        $cat_vet_log = CatVetLog::find($request->id);
        if(empty($cat_vet_log)){
            return response()->json("failed");
        }else{
            $cat_vet_log->delete();
            Storage::delete('$cat_vet_log->prescription_picture');
            return response()->json($request->id);
        }
    }

    public function yearlyVetLogs($year, $name, $user_email)
    {
        $result = DB::table('cats_vet_logs')->select('cats_vet_logs.*')
            ->whereYear('visit_date', $year)
            ->orderBy('visit_date', 'desc')
            ->where(['cat_name' => $name, 'user_email' => $user_email])
            ->get();
        return $result;
    }

    public function expensesPerMonth($vet_log_duringYear)
    {
        $expenses_per_month = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0, "6" => 0, "7" => 0, "8" => 0,
            "9" => 0, "10" => 0, "11" => 0, "12" => 0);
        foreach ($vet_log_duringYear as $vet_log) {
            $logDate = explode(" ", $vet_log->visit_date);
            $log_month = intval((explode("-", $logDate[0]))[1]);
            $expenses_per_month[$log_month] = $expenses_per_month[$log_month] + $vet_log->price;
        }
        return $expenses_per_month;
    }

    public function spentDuringYear($expenses)
    {
        $sum = 0;
        for ($i = 1; $i < 13; $i++) {
            $sum = $sum + $expenses[$i];
        }
        return $sum;
    }
    //    Natalie
    public function updateLog(Request $request){
        $currentUser = Auth::User();
        $my_log = $currentUser->catVetLogs()->where('id', $request->id)->first();
        if(empty($my_log))
            return response("vetlog not found", 204);

        $my_log->visit_date = $request->visit_date;
        $my_log->subject = $request->subject;
        $my_log->description = $request->description;
        $my_log->clinic_name = $request->clinic_name;
//        $my_log->prescription_image = $request->prescription_image;
        $my_log->price = $request->price;

        try{
            $my_log->save();
        }catch(QueryException $e){
            return response("Update failed", 500);
        }
//        return response()->json(['visit_date' => $my_log->visit_date,'subject'=>$my_log->subject,'description' => $my_log->description,
//        'clinic_name'=> $my_log->clinic_name, 'price'=> $my_log->price]);
        return response()->json(['subject' => $my_log->subject]);
    }
}
