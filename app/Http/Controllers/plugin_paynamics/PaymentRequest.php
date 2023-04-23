<?php

namespace App\Http\Controllers\plugin_paynamics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * https://mcrichtravel.com/partition-api-multi-purpose/version-6/public/api/plugin_paynamics/send
 * 
 */

class PaymentRequest extends Controller
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
        $trans_signature        = env("PAYNAMICS_MERCHANT_ID") . date("YMDhms") . env("PAYNAMICS_NOTIF_URL") . env("PAYNAMICS_RESPONSE_URL") . env("PAYNAMICS_CANCEL_URL") 
            . $user_token . $pmethod . $pchannel . $payment_action . $collection_method . $amount . $currency . $mlogo_url . $mtac_url . $payment_notif_status 
            . $payment_notif_channel;

        $transaction = [
            "merchant_id"                           => env("PAYNAMICS_MERCHANT_ID"),
            "request_id"                            => "TRN" . date("Ymdhis"),
            "notification_url"                      => env("PAYNAMICS_NOTIF_URL"),
            "response_url"                          => env("PAYNAMICS_RESPONSE_URL"),
            "cancel_url"                            => env("PAYNAMICS_CANCEL_URL"),
            "user_token"                            => $user_token,
            "pmethod"                               => $pmethod,
            "pchannel"                              => $pchannel,
            "payment_action"                        => $payment_action,
            "collection_method"                     => $collection_method,
            "amount"                                => $amount,
            "currency"                              => $currency,
            "mlogo_url"                             => $mlogo_url,
            "mtac_url"                              => $mtac_url,
            "payment_notification_status"           => $payment_notif_status,
            "payment_notification_channel"          => $payment_notif_channel,
            "signature"                             => hash("sha512", $trans_signature . $merchant_key)
        ];

        $fname      = "Jason";
        $lname      = "Lipreso";
        $mname      = "Barsalis";
        $email      = "jasonlipreso@gmail.com";
        $phone      = "N/A";
        $mobile     = "+639353152023";
        $dob        = "1994-02-17";
        $customer_signature = $fname . $lname . $mname . $email . $phone . $mobile . $dob;

        $customer_info = [
            "fname"             => $fname,
            "lname"             => $lname,
            "mname"             => $mname,
            "email"             => $email,
            "phone"             => $phone,
            "mobile"            => $mobile,
            "dob"               => $dob,
            "signature"         => hash("sha512", $customer_signature),
        ];

        $billing_info = [
            "billing_address1"          => "Apid Cantabaco, Toledo City, Cebu",
            "billing_address2"          => "Lawaan III, City of Talisay, Cebu",
            "billing_city"              => "Toledo",
            "billing_state"             => "Cebu",
            "billing_country"           => "Philippines",
            "billing_zip"               => "6038",
        ];

        $payload = [
            "transaction"               => $transaction,
            "customer_info"             => $customer_info,
            "billing_info"              => $billing_info,
            /*
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
            */
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
