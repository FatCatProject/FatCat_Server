<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cat;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
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
        $currentUser = auth()->user();

        $vetLogs = $this->yearlyVetLogs($year, $cat->cat_name, $currentUser->email);
        $expensesPerMonth = $this->expensesPerMonth($vetLogs);
        $totalExpenses = $this->spentDuringYear($expensesPerMonth);

        return view('pages.catVetPage', compact('cat'), compact('expensesPerMonth'))
            ->with('vetLogs', $vetLogs)->with('totalExpenses', $totalExpenses);
    }

    public function store(Request $request)
    {
        $year = new DateTime();
        $year = explode('-', $year->format('Y-m-d'))[0];

        if (Input::hasFile('prescription_picture')) {
            $file = Input::file('prescription_picture');
            $file->move('uploads', $file->getClientOriginalName());
            $encodedPrescriptionPicture = base64_encode($file);
        } else
            $encodedPrescriptionPicture = "";

        $status = "success";
        $cat = Cat::find($request->id);

        date_default_timezone_set('Asia/Jerusalem');
        $currentUser = auth()->user();
        if ($currentUser == null) {
            $status = "Failed, you need to sign in";
        } else {
            $visit_date = (new DateTime($request->visit_date))->format('Y-m-d');
            $now = new DateTime();
            DB::table('cats_vet_logs')->insert(
                ['user_email' => $currentUser->email, 'visit_date' => $visit_date, 'subject' => $request->subject,
                    'description' => $request->description, 'clinic_name' => $request->clinic_name,
                    'prescription_picture' => $encodedPrescriptionPicture, 'price' => $request->price,
                    'cat_name' => $cat->cat_name]
            );
        }

        return redirect()->back();
        /*
        return view('pages.catVetPage', compact('cat'), compact('expensesPerMonth'))
            ->with('vetLogs', $vetLogs)->with('totalExpenses', $totalExpenses);
        */
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

    public function expensesPerMonth($vetLogDuringYear)
    {
        $expensesPerMonth = array("1" => 0, "2" => 0, "3" => 0, "4" => 0, "5" => 0, "6" => 0, "7" => 0, "8" => 0,
            "9" => 0, "10" => 0, "11" => 0, "12" => 0);
        foreach ($vetLogDuringYear as $vetLog) {
            $logDate = explode(" ", $vetLog->visit_date);
            $logMonth = intval((explode("-", $logDate[0]))[1]);
            $expensesPerMonth[$logMonth] = $expensesPerMonth[$logMonth] + $vetLog->price;
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

}
