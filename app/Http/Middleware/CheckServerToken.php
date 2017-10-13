<?php

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Closure;
use App\User;
use Illuminate\Http\Request;

class CheckServerToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!$request->hasHeader("php-auth-user") || !$request->hasHeader("php-auth-pw")) {
            return response("", 401);
        }
        $auth_user = $request->header("php-auth-user");
        $auth_pw = $request->header("php-auth-pw");
        try {
            $request_user = User::where("email", $auth_user)->firstOrFail();
            if ($request_user->server_token !== $auth_pw) {
                return response("", 401);
            }
        } catch (ModelNotFoundException $e) {
            return response("", 401);
        }
        $request->attributes->add(["request_user" => $request_user]);

        return $next($request);
    }
}
