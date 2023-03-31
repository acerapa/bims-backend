<?php

namespace Project\CIMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CIMSController extends Controller
{
    public static function variables() {
        return [
            "variable1" => "variable1",
            "variable2" => "variable2"
        ];
    }
}
