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
//        TODO - Log IP if login failed

        if (!$request->hasHeader("server-token-user") || !$request->hasHeader("server-token-pw")) {
            return response("", 401);
        }
        $auth_user = $request->header("server-token-user");
        $auth_pw = $request->header("server-token-pw");
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
