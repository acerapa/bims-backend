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

        }
        else if($hostname == "foxcityph.tech") {

            Environment::setKeyValue("DB_CONNECTION", "mysql");
            Environment::setKeyValue("DB_HOST", "185.201.9.191");
            Environment::setKeyValue("DB_PORT", "3306");
            Environment::setKeyValue("DB_DATABASE", "foxc_foxcity");
            Environment::setKeyValue("DB_USERNAME", "foxc_foxcity");
            Environment::setKeyValue("DB_PASSWORD", "ovy2hcHxx22uLwqe");
            Environment::setKeyValue("MAIL_MAILER", "smtp");
            Environment::setKeyValue("MAIL_HOST", "smtp.hostinger.com");
            Environment::setKeyValue("MAIL_PORT", "465");
            Environment::setKeyValue("MAIL_USERNAME", "NO_VALUE");
            Environment::setKeyValue("MAIL_PASSWORD", "NO_VALUE");
            Environment::setKeyValue("MAIL_ENCRYPTION", "tls");
            Environment::setKeyValue("MAIL_FROM_ADDRESS", "NO_VALUE");
            Environment::setKeyValue("MAIL_FROM_NAME", "NO_VALUE");
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
