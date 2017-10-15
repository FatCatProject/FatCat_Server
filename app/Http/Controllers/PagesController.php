<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
//use Illuminate\View\View;

class PagesController extends Controller
{
    public function index(){
        if(View::exists('pages.index'))
            return view('pages.index');
        else
            return 'No such view';
    }

    public function addCat(){
        if(View::exists('pages.addCat'))
            return view('pages.addCat','CatController@breeds');
        else
            return 'No pages.addCat view';
    }
}
