<?php

namespace App\Http\Controllers\plugin_user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Personalize extends Controller
{
    public static function setDarkMode() {
        return true;
    }

    public static function setLightMode() {
        return true;
    }

    public static function setCustomMode() {
        return true;
    }
}
