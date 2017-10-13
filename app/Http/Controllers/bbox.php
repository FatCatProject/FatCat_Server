<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class bbox extends Controller
{

    public function head_check_connection(Request $request)
    {
        return response("", 200);
    }

    public function get_server_token(Request $request)
    {
        if (!$request->hasHeader("php-auth-user") || !$request->hasHeader("php-auth-pw")) {
            return response("", 401);
        }
        $auth_user = $request->header("php-auth-user");
        $auth_pw = $request->header("php-auth-pw");

        if (!Auth::attempt(['email' => $auth_user, 'password' => $auth_pw])) {
            return response("", 401);
        }
        $request_user = Auth::user();
        $request_user_brainbox = $request_user->brainbox;
        $request_user_brainbox->brainbox_ip = $request->ip();
        $request_user_brainbox->last_seen = new \DateTime();
        $request_user_brainbox->save();

        return response()->json(["server_token" => Auth::user()->server_token]);
    }
}
