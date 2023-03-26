<?php

namespace Project\Flipcard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * http://127.0.0.1:8000/flipcard/submit?user_refid=2212&card=5&bit=10&prize=567&gold_card=1&gold_guess=3&is_win=1
 * 
 * Minimum Withdrawal: 50
 * 
 */

class FlipcardController extends Controller
{
    public static function submit(Request $request) {

        $user_profile   = FlipcardController::getUserProfile($request['user_refid']);
        $game_win       = 0;
        $num_of_card    = $request['card'];

        if(count($user_profile) == 0) {
            return [
                "success"   => false,
                "message"   => "Gamer profile is not available"
            ];
        }
        else {
            $balance            = floatval($user_profile[0]->balance);
            $is_free            = $user_profile[0]->is_free;
            $total_bit_amount   = floatval($user_profile[0]->total_bit_amount);
            $total_top_up       = floatval($user_profile[0]->total_top_up);
            $total_game         = floatval($user_profile[0]->total_game);

            if($balance < floatval($request['bit'])) {
                return [
                    "success"   => false,
                    "message"   => "You have insufficient balance, please select only bit less than " . $balance
                ];
            }

            if($is_free == 1) {
                /**
                 * Rules:
                 * 1: if balance is greater than 150, loss
                 * 2: 
                 */
                if($balance >= 100) {
                    $game_win   = 0;
                }
                else {
                    $game_win   = rand(0,1);
                }
            }
            else {
                /**
                 * Rules:
                 * 1: if balance is greater than 300, loss
                 * 2: 
                 */
                if($balance > 300) {
                    $game_win   = 0;
                }
                else {
                    $game_win   = rand(0,1);
                }
            }
        }

        $balance_new    = $balance - intval($request['bit']);

        if($game_win == 1) {
            $gold_card      = $request['gold_guess'];
            $gold_guess     = $request['gold_guess'];
            $balance_new    = $balance_new + intval($request['prize']);
        }
        else {

            $gold_guess     = intval($request['gold_guess']);
            
            if($num_of_card == '4') {
                $card_array_4 = [1,2,3,4];
                unset($card_array_4[$gold_guess]);
                $gold_card      = array_rand($card_array_4);
            }
            else if($num_of_card == '6') {
                $card_array_6 = [1,2,3,4,5,6];
                unset($card_array_6[$gold_guess]);
                $gold_card      = array_rand($card_array_6);
            }
            else if($num_of_card == '9') {
                $card_array_9 = [1,2,3,4,5,6,7,8,9];
                unset($card_array_9[$gold_guess]);
                $gold_card      = array_rand($card_array_9);
            }   
        }

        $total_bit_update = $total_bit_amount + intval($request['prize']);
        
            

        $logged = DB::table("flipcard_game")->insert([
            "user_refid"    => $request['user_refid'],
            "card"          => $request['card'],
            "bit"           => $request['bit'],
            "prize"         => $request['prize'],
            "gold_card"     => $gold_card,
            "gold_guess"    => $request['gold_guess'],
            "is_win"        => $game_win
        ]);

        if($logged) {
            
            DB::table("plugin_user")
            ->where("reference_id", $request['user_refid'])
            ->update([
                "total_bit_amount"  => $total_bit_update,
                "total_game"        => ($total_game + 1),
                "balance"           => $balance_new
            ]);
            return [
                "success"       => true,
                "message"       => "Successfully logged",
                "card"          => $request['card'],
                "bit"           => $request['bit'],
                "prize"         => $request['prize'],
                "gold_card"     => $gold_card,
                "gold_guess"    => $request['gold_guess'],
                "is_win"        => $game_win,
                "balance"       => $balance_new
            ];
        }
        else {
            return [
                "success" => false,
                "message" => "Something went wrong"
            ];
        }
    }

    public static function getUserProfile($user_refid) {
        return DB::table("plugin_user")
        ->select("firstname","lastname","email","balance","is_free","total_bit_amount","total_top_up","total_game")
        ->where("reference_id", $user_refid)
        ->get();
    }
}
