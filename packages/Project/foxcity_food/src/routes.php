<?php

Route::group(['prefix' => 'foxcity_food'], function () {
    Route::get("init/{json_file}/{user_refid}",[Project\FoxcityFood\Init::class, 'init']);
    Route::get("store_profile/{json_file}/{store_refid}",[Project\FoxcityFood\Store::class, 'profile']);
    Route::get("mycart/{json_file}/{user_refid}/{store_refid}",[Project\FoxcityFood\MyCart::class, 'get']);
});