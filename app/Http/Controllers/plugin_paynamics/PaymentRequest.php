<?php

namespace App\Http\Controllers\plugin_paynamics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentRequest extends Controller
{
    public static function send() {

        $user_token             = "USR-" . date("YMDhms") . "-". date("YMDhms");
        $url                    = env("PAYNAMICS_END_POINT_URL");
        $account_hash           = env("PAYNAMICS_BASIC_AUTH_USERNAME") . ":" . env("PAYNAMICS_BASIC_AUTH_PASSWORD");
        $headers                = array("Authorization:Basic=". hash("sha512", $account_hash),"Content-Type:application/json");
        $pmethod                = "wallet";
        $pchannel               = "";
        $payment_action         = "";
        $collection_method      = "";
        $amount                 = "";
        $currency               = "";
        $mlogo_url              = "";
        $mtac_url               = "";
        $payment_notif_status   = "";
        $payment_notif_channel  = "";

        $trans_signature = env("PAYNAMICS_MERCHANT_ID") . date("YMDhms") . env("PAYNAMICS_NOTIF_URL") . env("PAYNAMICS_RESPONSE_URL") . env("PAYNAMICS_CANCEL_URL")
            . $user_token .

        $transaction = [
            "merchant_id"                           => env("PAYNAMICS_MERCHANT_ID"),
            "request_id"                            => date("YMDhms"),
            "notification_url"                      => env("PAYNAMICS_NOTIF_URL"),
            "response_url"                          => env("PAYNAMICS_RESPONSE_URL"),
            "cancel_url"                            => env("PAYNAMICS_CANCEL_URL"),
            "user_token"                            => $user_token,
            "pmethod"                               => "wallet",
            "pchannel"                              => "",
            "payment_action"                        => "transfer",
            "collection_method"                     => "single_pay",
            "amount"                                => 176.98,
            "currency"                              => "PHP",
            "mlogo_url"                             => "https://mcrichtravel.com/images/logo-100x100.png",
            "mtac_url"                              => "https://mcrichtravel.com/terms-and-conditions",
            "payment_notification_status"           => 4,
            "payment_notification_channel"          => 1,
            "signature"                             => hash("sha512", $trans_signature),
        ];

        $customer_info = [
            "fname"             => "",
            "lname"             => "",
            "mname"             => "",
            "email"             => "",
            "phone"             => "",
            "mobile"            => "",
            "dob"               => "",
            "signature"         => "",
        ];

        $billing_info = [
            "billing_address1"         => "",
            "billing_address2"         => "",
            "billing_city"         => "",
            "billing_state"         => "",
            "billing_country"         => "",
            "billing_zip"         => "",
        ];

        $payload = [
            "transaction"               => $transaction,
            "customer_info"             => $customer_info,
            "billing_info"              => $billing_info,

            "client_ip"                 => "",
            "device_identifier"         => "",
            "device_information"        => "",
            "user_agent"                => "",
            "os_version"                => "",
            "browser_resolution"        => "",
            "gps_coordinates"           => "",
            "sim_info"                  => "",
            "number_of_apps_installed"  => "",

            "success_email"             => "",
            "success_sms"               => "",
            "fail_email"                => "",
            "fail_sms"                  => "",

            "system_id"                 => "",
            "field"                     => "",
            "label"                     => "",
            "value"                     => ""
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
