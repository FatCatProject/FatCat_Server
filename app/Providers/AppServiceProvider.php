<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cat;
use App\User;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        //added by Natalie -
//        if(!Auth::check()){
//            return;
//        }
//        //
        Schema::defaultStringLength(191);
        View::share('userName','SomeUser');
        View::composer('*',function ($view){
            $cats = DB::table('cats')->where('user_email',Auth::user()->email)->get();
            $view->with('mycats',$cats);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
