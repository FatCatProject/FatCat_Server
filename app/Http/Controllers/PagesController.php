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
    public function home(){
        if(View::exists('pages.homePage'))
            return view('pages.homePage');
        else
            return 'No pages.homePage view';
    }
    public function shop(){
        if(View::exists('pages.shoppingPage'))
            return view('pages.shoppingPage');
        else
            return 'No pages.shoppingPage view';
    }
    public function shopList(){
        if(View::exists('pages.shopsPage'))
            return view('pages.shopsPage');
        else
            return 'No pages.shopsPage view';
    }
    public function userPage(){
        if(View::exists('pages.userPage'))
            return view('pages.userPage');
        else
            return 'No pages.userPage view';
    }

    public function boxManagePage(){
        if(View::exists('pages.boxManagePage'))
            return view('pages.boxManagePage');
        else
            return 'No pages.boxManagePage view';
    }
    public function editBoxPage(){
        if(View::exists('pages.editBoxPage'))
            return view('pages.editBoxPage');
        else
            return 'No pages.editBoxPage view';
    }
    public function cardsPage(){
        if(View::exists('pages.cardsPage'))
            return view('pages.cardsPage');
        else
            return 'No pages.cardsPage view';
    }
}
