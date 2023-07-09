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

        $merchant_id                    = "0000001703230B451534";
        $request_id                     = "PYNMC671784591234";
        $notification_url               = "https://mcrichtravel.com/notification/";
        $response_url                   = "https://mcrichtravel.com/response/";
        $cancel_url                     = "https://mcrichtravel.com/cancelled/";
        $user_token                     = "USR000000000112556";
        $pmethod                        = "direct_otc";
        $pchannel                       = "mlhuillier_ph;ecpay_ph;da5_ph";
        $payment_action                 = "url_link";
        $collection_method              = "single_pay";
        $amount                         = "891.99";
        $currency                       = "php";
        $descriptor_note                = "Mcrich Booking";
        $mlogo_url                      = "https://mcrichtravel.com/images/logo-100x100.png";
        $mtac_url                       = "https://mcrichtravel.com/terms-and-conditions";
        $payment_notification_status    = 2;
        $payment_notification_channel   = 1;
        $secure3d                       = "try3d";

        
            $transaction = [
                "merchant_id"                   => $merchant_id,
                "request_id"                    => $request_id,
                "notification_url"              => $notification_url,
                "response_url"                  => $response_url,
                "cancel_url"                    => $cancel_url,
                "user_token"                    => $user_token,
                "pmethod"                       => $pmethod,
                "pchannel"                      => $pchannel,
                "payment_action"                => $payment_action,
                "collection_method"             => $collection_method,
                "amount"                        => $amount,
                "currency"                      => $currency,
                "descriptor_note"               => $descriptor_note,
                "mlogo_url"                     => $mlogo_url,
                "mtac_url"                      => $mtac_url,
                "payment_notification_status"   => $payment_notification_status,
                "payment_notification_channel"  => $payment_notification_channel,
                "secure3d"                      => $secure3d,
                "signature"                     => hash("sha512", $merchant_id . $request_id . $notification_url . $response_url . $cancel_url . $user_token . $pmethod . $pchannel . $payment_action . $collection_method . $amount . $currency . $descriptor_note . $mlogo_url . $mtac_url . $payment_notification_status . $payment_notification_channel . $secure3d . "BB0B48519749896540B274CDCA2F94C4")
            ];

            $customer_info = [
                "fname"                 => "Jason",
                "lname"                 => "Lipreso",
                "mname"                 => "Barsalis",
                "email"                 => "jasonlipreso@gmail.com",
                "dob"                   => "1994-02-17",
                "signature"             => hash("sha512", "JasonLipresoBarsalisjasonlipreso@gmail.com1994-02-17")
            ];

            $billing_info = [
                "billing_address1"      => "Lawaan 3 Talisay City Cebu",
                "billing_address2"      => "Cantabaco Toledo City Cebu",
                "billing_city"          => "Talisay",
                "billing_state"         => "Cebu",
                "billing_country"       => "PHP",
                "billing_zip"           => "6036"
            ];
        

            $header_hash = base64_encode("mcrich5ja1:5ja1oOyOROFH");

            $url        = "https://payin.paynamics.net/paygate/transactions/";
            $apikey     = "BB0B48519749896540B274CDCA2F94C4";

            $headers    = array(
                "Authorization:key=".$apikey,
                "Content-Type:application/json"
            );

            $payload = [
                "transaction"       => $transaction,
                "customer_info"     => $customer_info,
                "billing_info"      => $billing_info
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization:Basic" . base64_encode("mcrich5ja1:5ja1oOyOROFH")));
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $return = curl_exec($ch);
            curl_close($ch);

            echo $return;

    }

    public static function query() {

        $url                = "https://payin.paynamics.net/paygate/transactions/";
        $merchant_id        = "0000001703230B451534";
        $request_id         = "PYNMC671784591234";

        $payload    = [
            "merchant_id"   => $merchant_id,
            "request_id"    => $request_id,
            "org_trxid2"    => $request_id,
            "signature"     => hash("sha512", $merchant_id . $request_id . $request_id . "BB0B48519749896540B274CDCA2F94C4")
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization:Basic" . base64_encode("mcrich5ja1:5ja1oOyOROFH")));
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $return = curl_exec($ch);
        curl_close($ch);

        echo $return;
    }
}
