<?php

namespace App\Http\Controllers\plugin_email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

/**
 * References:
 * https://stackoverflow.com/questions/26139931/laravel-mail-pass-string-instead-of-view
 * 
 * api/plugin_email/sendText?content=Sample&to_email=jasonlipreso@gmail.com&to_name=Jason Lipreso&subject=Hi THIS si a test
 * api/plugin_email/sendHTML?content=Sample&to_email=jasonlipreso@gmail.com&to_name=Jason Lipreso&subject=Hi THIS si a test
 */

class SendBasic extends Controller
{
    public static function sendText(Request $request) {

        $content    = $request['content'];
        $to_email   = $request['to_email'];
        $to_name    = $request['to_name'];
        $subject    = $request['subject'];

        try {
            Mail::raw($content, function ($message) use($to_email, $to_name, $subject) {
                $message->to($to_email, $to_name)->subject($subject);
            });

            return [
                "success"   => true,
                "message"   => "Email successfully sent"
            ];
        }
        catch(\Exception $e) {
            return $e;
        }
    }

    public static function sendHTML(Request $request) {

        $content    = $request['content'];
        $to_email   = $request['to_email'];
        $to_name    = $request['to_name'];
        $subject    = $request['subject'];

        try {
            Mail::html($content, function ($message) use($to_email, $to_name, $subject) {
                $message->to($to_email, $to_name)->subject($subject);
            });

            return [
                "success"   => true,
                "message"   => "Email successfully sent"
            ];
        }
        catch(\Exception $e) {
            return $e;
        }
    }
}
