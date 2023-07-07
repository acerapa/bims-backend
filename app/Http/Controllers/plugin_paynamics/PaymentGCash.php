<?php

namespace App\Http\Controllers\plugin_paynamics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentGCash extends Controller
{
    public static function send() {

        $user_token             = "USR-" . date("YMDhms") . "-". date("YMDhms");
        $merchant_key           = env("PAYNAMICS_MERCHANT_KEY");
        $url                    = "https://payin.payserv.net/paygate/transactions"; // env("PAYNAMICS_END_POINT_URL");
        $account_hash           = env("PAYNAMICS_BASIC_AUTH_USERNAME") . ":" . env("PAYNAMICS_BASIC_AUTH_PASSWORD");
        $headers                = array("Authorization:Basic=". hash("sha512", $account_hash),"Content-Type:application/json");
        $pmethod                = "wallet";
        $pchannel               = "gc";
        $payment_action         = "transfer";
        $collection_method      = "single_pay";
        $amount                 = 176.98;
        $currency               = "php";
        $mlogo_url              = env("PAYNAMICS_MERCHANT_LOGO");
        $mtac_url               = env("PAYNAMICS_MERCHANT_TAC");
        $payment_notif_status   = 4;
        $payment_notif_channel  = 1;
        
        $transaction = [
            "merchant_id"                   => env("PAYNAMICS_MERCHANT_ID"),
            "request_id"                    => "PYNMC" . rand(1000000, 9999999),
            "notification_url"              => "http://testpti.payserv.net/truemoney/NotificationReceiver.aspx",
            "response_url"                  => "http://testpti.payserv.net/truemoney/NotificationReceiver.aspx",
            "cancel_url"                    => "http://testpti.payserv.net/truemoney/NotificationReceiver.aspx",
            "pmethod"                       => "nonbank_otc",
            "pchannel"                      => "truemoney_ph",
            "payment_action"                => "direct_otc",
            "collection_method"             => "single_pay",
            "amount"                        => "5.00",
            "currency"                      => "PHP",
            "descriptor_note"               => "Paynamics Technologies Inc.",
            "pay_reference"                 => "PNX587589521",
            "payment_notification_status"   => "1",
            "expiry_limit"                  => "2023-05-05 12:22:4",
        ];

        $transac_all_string = "";
        $transac_keys = array_keys($transaction);
        for($a = 0; $a < count($transac_keys); $a++) {
            if($transaction[$transac_keys[$a]]) {
                $transac_all_string = $transac_all_string . $transaction[$transac_keys[$a]];
            }
        }

        $customer_info = [
            "fname"                         => "Juan",
            "lname"                         => "dela Cruz",
            "mname"                         => "Santos",
            "email"                         => "janna.talidong@paynamics.net",
            "phone"                         => "330-8227",
            "mobile"                        => "09123456789"
        ];

        $customer_all_string = "";
        $customer_keys = array_keys($customer_info);
        for($a = 0; $a < count($customer_keys); $a++) {
            if($customer_info[$customer_keys[$a]]) {
                $customer_all_string = $customer_all_string . $customer_info[$customer_keys[$a]];
            }
        }

        return [
            "headers"                   => $headers,
            "transaction_data"          => $transaction,
            "transaction_sign"          => hash("sha512", $transac_all_string),
            "customer_data"             => $customer_info,
            "customer_sign"             => hash("sha512", $customer_all_string)
        ];
    }
}
