<?php

namespace App\Http\Controllers\plugin_paynamics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetConversionAmount;
use App\Soap\Response\GetConversionAmountResponse;

/**
 * https://github.com/notfalsedev/laravel-soap
 */

class PaymentSale extends Controller
{
    public static function post(Request $request) {
        $init   = ini_set("soap.wsdl_cache_enabled", 0);
        $client = new SoapClient("https://testpti.payserv.net/Paygate/ccservice.asmx?WSDL");
        return $client;
    }
}
