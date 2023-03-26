<?php

namespace Project\Flipcard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlipcardController extends Controller
{
    public static function set() {
        return [
            "success"   => true,
            "message"   => "Success!"
        ];
    }
}
