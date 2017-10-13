<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bbox extends Controller
{

    public function head_check_connection(Request $request)
    {
        return response("", 200);
    }


}
