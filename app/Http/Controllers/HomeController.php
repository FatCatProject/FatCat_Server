<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function homePage()
    {
        $cats = \App::call('App\Http\Controllers\CatController@myCats');
        if (count($cats) / 3 > intval(count($cats) / 3))
            $numberOfRows = intval(count($cats) / 3) + 1;
        else
            $numberOfRows = intval(count($cats)) / 3;

        return view('pages.homePage', compact('numberOfRows'), compact('cats'));
    }
}
