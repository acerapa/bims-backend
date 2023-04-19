<?php

/**
 * Register all laravel plugins to a system data by adding script tag inside header tag
 * 
 * 
 */

    if(gethostname() == 'localhost') {
        $laravel_hostname = "http://127.0.0.1:8000/";
    }
    else {
        $laravel_hostname = "https://mcrichtravel.com/partition-api-multi-purpose/version-5/public/";
    }
  
    $laravel_plugins  = [
        "plugin_config",
        "plugin_auth",
        "plugin_blog",
        "plugin_faq",
        "plugin_currency",
        "plugin_datetime",
        "plugin_geo",
        "plugin_inquiry_web_form",
        "plugin_inquiry",
        "plugin_gps",
        "plugin_json_data",
        "plugin_localstorage_with_expiry",
        "plugin_mailer",
        "plugin_photos",
        "plugin_query",
        "plugin_reference_id",
        "plugin_review",
        "plugin_ui",
        "plugin_url",
        "plugin_user",
        "plugin_util_object_array",
        "plugin_validator"
    ];

    foreach($laravel_plugins as $Laraplug) {
        echo "<script type='text/javascript' src='". $laravel_hostname ."js/". $Laraplug .".js'></script>";
    }