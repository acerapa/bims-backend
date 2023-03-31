<?php

namespace Project\ExploriaTravel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ExploriaTravelController extends Controller
{
    public static function variables() {
        return [
            "variable1" => "variable1",
            "variable2" => "variable2"
        ];
    }
}
