<?php

namespace App\Http\Controllers;

use App\CatBreed;
use App\Cat;
use App\FeedingLog;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function breeds()
    {
        $breeds = CatBreed::all();
        return view('pages.addCat', compact('breeds'));
    }

    public function catPage(){
//  IMPORTANT:  getting all cats and all logs - just for view checking purposes !!!
        $catInfo = Cat::all();
        $catLogs = FeedingLog::all();
        return view('pages.catPage',compact('catInfo'),compact('catLogs'));

    }
}
