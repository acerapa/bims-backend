<?php

namespace App\Http\Controllers\plugin_project_config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Switch Environment
 * api/plugin_project_config/setProjectEnv/mcrichtravel.com
 * api/plugin_project_config/setProjectEnvAuto
 * 
 * Get Git Info
 * api/plugin_project_config/gitInfo
 * 
 * \App\Http\Controllers\plugin_project_config\setProjectEnv($hostname)
 * 
 * 
 */

class Environment extends Controller
{
    public static function setProjectEnvAuto() {
        
        $git        = Environment::gitInfo();
        $branch     = $git['branch'];

        if($branch == 'Editor') {
            Environment::setProjectEnv("local");
        }
        else if($branch == 'Project-Deanlief') {
            Environment::setProjectEnv("deanleifproperties.com");
        }
        else if($branch == 'Project-Mcrich') {
            Environment::setProjectEnv("mcrichtravel.com");
        }
        else if($branch == 'Project-Foxcity') {
            Environment::setProjectEnv("foxcityph.com");
        }
        else {
            Environment::setProjectEnv("local");
        }
    }

    public static function setProjectEnv($hostname) {

        if($hostname == "mcrichtravel.com") {

            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "82.180.152.1");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "u604418523_mcrich");
            Environment::setKeyValue("DB_USERNAME", "u604418523_mcrich");
            Environment::setKeyValue("DB_PASSWORD", "&U4rVLqP");

            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "operator@mcrichtravel.com");
            Environment::setKeyValue("MAIL_PASSWORD", "MC_1231rich");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "operator@mcrichtravel.com");
            Environment::setKeyValue("MAIL_FROM_NAME", "Mcrich_Operator_Official");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "NO_VALUE");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "0000001703230B451534");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "BB0B48519749896540B274CDCA2F94C4");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "https://payin.payserv.net/paygate/transactions/");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "https://testpti.payserv.net/Paygate/ccservice.asmx?WSDL");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "https://ptidashboard.payserv.net/signin");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "mcrich");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "y07L75r4Kc7h");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "mcrich5ja1");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "5ja1oOyOROFH");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "https://mcrichtravel.com/payment-notification.php");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "https://mcrichtravel.com/payment-success.php");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "https://mcrichtravel.com/payment-cancelled.php");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "https://mcrichtravel.com/images/logo-100x100.png");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "https://mcrichtravel.com/terms-and-conditions");

        }
        else if($hostname == "deanleifproperties.com") {
            
            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "82.180.152.1");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "u604418523_deanlief");
            Environment::setKeyValue("DB_USERNAME", "u604418523_fc_main_dev");
            Environment::setKeyValue("DB_PASSWORD", "?AYcGCBKcl6");

            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "NO_VALUE");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
        else if($hostname == "foxcityph.tech") {

            /***********************************************
             * Nation Wide Database:
             ***********************************************
             *      Host: 185.201.9.191
             *      Database Name: foxc_shop_national
             *      User Name: foxc_foxc_nw_161710
             *      Password: bDr2JwoKu@4M77jh
             * 
             ***********************************************
             * Local Database:
             ***********************************************
             *      Host: 185.201.9.191
             *      Database Name: foxc_foxcity
             *      User Name: foxc_foxcity
             *      Password: ovy2hcHxx22uLwqe
             */

            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "185.201.9.191");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "foxc_shop_national");
            Environment::setKeyValue("DB_USERNAME", "foxc_foxc_nw_161710");
            Environment::setKeyValue("DB_PASSWORD", "bDr2JwoKu@4M77jh");

            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "AIzaSyD6LoE8AK-28QW-LTWtTSx68Alum0ft94g");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
        else if($hostname == "flipcard.fun") {

            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "45.130.228.154");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "u200905711_clipcard");
            Environment::setKeyValue("DB_USERNAME", "u200905711_clipcard");
            Environment::setKeyValue("DB_PASSWORD", "!e7Pj3IQvF");
            
            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "inquiry@flipcard.fun");
            Environment::setKeyValue("MAIL_PASSWORD", "JazzRylle_161710");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "inquiry@flipcard.fun");
            Environment::setKeyValue("MAIL_FROM_NAME", "Flipcard_Official");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "NO_VALUE");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
        else if($hostname == "cims.com") {
            
            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "45.130.228.154");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "u200905711_jl_cims");
            Environment::setKeyValue("DB_USERNAME", "u200905711_jl_cims");
            Environment::setKeyValue("DB_PASSWORD", "NSbWzt>Q5t");
            
            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "386384297859");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "cims-382710");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "AIzaSyCBarUcMUAi3XsZ9j7XO415Gnn1o4fA5y0");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
        else if($hostname == "multistoreapp.tech") {
            
            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "185.201.9.191");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "foxc_multi_store_app");
            Environment::setKeyValue("DB_USERNAME", "foxc_multi_store_app");
            Environment::setKeyValue("DB_PASSWORD", "ILqGfq2#t31doxD^");
            
            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "AIzaSyD6LoE8AK-28QW-LTWtTSx68Alum0ft94g");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
        else {

            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "45.130.228.154");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "u200905711_multipurpose");
            Environment::setKeyValue("DB_USERNAME", "u200905711_multipurpose");
            Environment::setKeyValue("DB_PASSWORD", ":5zT*x![yM");

            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");

            Environment::setKeyValue("GOOGLE_PROJECT_NUMBER", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_PROJECT_ID", "NO_VALUE");
            Environment::setKeyValue("GOOGLE_MAP_API_KEY", "NO_VALUE");

            Environment::setKeyValue("PAYNAMICS_MERCHANT_ID", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_KEY", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_END_POINT_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_TEST_API", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_DASHBOARD_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_USERNAME", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_BASIC_AUTH_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_NOTIF_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_RESPONSE_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_CANCEL_URL", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_LOGO", "NO_VALUE");
            Environment::setKeyValue("PAYNAMICS_MERCHANT_TAC", "NO_VALUE");

        }
    }

    public static function setKeyValue($key, $value) {
        $path   = base_path('.env');
        if (getenv($key)) {
            file_put_contents($path, str_replace("$key=" . getenv($key), "$key=" . $value, file_get_contents($path)));
        }
        else {
            $file   = file($path);
            $file[] = "$key=" . $value;
            file_put_contents($path, $file);
        }
    }

    public static function gitInfo() {

        $gitBasePath    = base_path().'/.git';
        $gitStr         = file_get_contents($gitBasePath.'/HEAD');
        $gitBranchName  = rtrim(preg_replace("/(.*?\/){2}/", '', $gitStr));                                                                                            
        $gitPathBranch  = $gitBasePath.'/refs/heads/'.$gitBranchName;
        $gitHash        = file_get_contents($gitPathBranch);
        $gitDate        = date(DATE_ATOM, filemtime($gitPathBranch));

        return [
            "version_date"  => $gitDate,
            "branch"        => $gitBranchName,
            "commit"        => $gitHash
        ];
    }
}
