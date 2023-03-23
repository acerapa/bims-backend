<?php

namespace App\Http\Controllers\plugin_reaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReactionList extends Controller
{
    public static function get() {
        return [
            [
                "name"      => "thumbs_up",
                "label"     => "Thumbs Up",
                "icon"      => "thumbs-up.png",
                "enabled"   => true,
            ],
            [
                "name"      => "thumbs_down",
                "label"     => "Thumbs down",
                "icon"      => "thumbs-down.png",
                "enabled"   => true,
            ],
            [
                "name"      => "heart",
                "label"     => "Heart",
                "icon"      => "heart.png",
                "enabled"   => true,
            ],
            [
                "name"      => "hahaha",
                "label"     => "Hahaha",
                "icon"      => "hahaha.png",
                "enabled"   => true,
            ],
            [
                "name"      => "sad",
                "label"     => "Sad",
                "icon"      => "sad.png",
                "enabled"   => true,
            ],
            [
                "name"      => "angry",
                "label"     => "Angry",
                "icon"      => "angry.png",
                "enabled"   => true,
            ]
        ];
    }
}
