<?php

namespace Project\Flipcard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * flipcard/submit?user_refid=2212&card=5&bit=10&prize=567&gold_card=1&gold_guess=3&is_win=1
 * flipcard/cashout?user_refid=XXXX&amount=100&gcash_number=099
 * 
 * Minimum Withdrawal: 50
 * 
 */

class FlipcardController extends Controller
{
    public static function cashout(Request $request) {

        $hasPending     = DB::table("flipcard_cashout")->where([["user_refid", $request['user_refid']],["status","1"]])->count();
        $user_profile   = FlipcardController::getUserProfile($request['user_refid']);
        $balance        = floatval($user_profile[0]->balance);
        $amount         = floatval($request['amount']);
        $isVerified     = $user_profile[0]->is_email_verified;

        if($isVerified == 0) {
            return [
                "success" => false,
                "message"   => "Please verify your email to cash out, we sent a verification email during account registration. Please check your email."
            ];
        }
        else if($amount < 50) {
            return [
                "success" => false,
                "message"   => "The minimum cashout amount is 50 pesos, play again to earn more."
            ];
        }
        else if($hasPending > 0) {
            return [
                "success" => false,
                "message"   => "You have pending cash out request, only one pending request are allowed."
            ];
        }
        else if($balance < $amount) {
            return [
                "success" => false,
                "message"   => "Your requested amount exceed from your available balance."
            ];
        }
        else {
            $balance_new = $balance - $amount;
            $logged = DB::table("flipcard_cashout")->insert([
                "user_refid"    => $request['user_refid'],
                "gcash_number"  => $request['gcash_number'],
                "amount"        => $request['amount']
            ]);

            if($logged) {
                DB::table("plugin_user")->where("reference_id", $request['user_refid'])->update(["balance" => $balance_new]);
                return [
                    "success"   => true,
                    "message"   => "Cash out request sent successfully, your cash will be sent within 15-30 min.",
                    "balance"   => $balance_new
                ];
            }
            else {
                return [
                    "success"   => false,
                    "message"   => "The system refused your request, please try again later."
                ];
            }
        }
    }

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

            if(($is_free == 1) && ($balance >= 100)) {
                /**
                 * Rules:
                 * 1: if balance is greater than 150, loss
                 */
                $game_win   = 0;
            }
            else {
                /**
                 * Rules:
                 * 1: if balance is greater than 300, loss
                 */
                if(($balance > 300) || (floatval($request['bit']) > 30)) {
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
        ->select("firstname","lastname","email","balance","is_free","total_bit_amount","total_top_up","total_game","is_email_verified")
        ->where("reference_id", $user_refid)
        ->get();
    }
}
