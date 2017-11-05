<?php

namespace App\Http\Middleware;

use Closure;
use App\Cat;
use Illuminate\Support\Facades\Auth;

class PrivacyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url = $request->getRequestUri();
        $catId = explode('/',$url)[2];
        $Cat = Cat::find($catId);
        if($Cat == null) // In case there is no cat with the id supplied
            return redirect()->back();
        $currentUser = auth()->user();
        if ($currentUser->email == $Cat->user_email)
            return $next($request);
        return redirect()->back();
    }
}
