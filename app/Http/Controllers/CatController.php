<?php

namespace App\Http\Controllers;

use App\CatBreed;
use App\Cat;
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
        return view('pages.catPage', compact('catInfo'), compact('catLogs'));

    }
    public function autocomplete(Request $request){
        $breedSearch = $request->input('searchTerm');
        $queries = DB::table('cat_breeds')
            ->where('breed_name', 'LIKE', '%'.$breedSearch.'%')->pluck('breed_name');

        return response()->json($queries);
    }

    public function dailyEating($id,$date){
        $cat = Cat::find($id);
        $card_ids = array();
        $card_ids = DB::table('cards')->where('cat_id',$cat->id)->get();
        $dailyFeedingLogs= Array();
        foreach ($card_ids as $card_id){
            $FeedingLogs = DB::table('feeding_logs')->where(
                ['card_id',$card_id->card_id],
                ['card_id',$card_id->card_id],
            )->get();
            array_push($dailyFeedingLogs,$FeedingLogs);
        }
        return $dailyFeedingLogs;
    }

}
