<?php

Route::group(['prefix' => 'foxcity_food'], function () {
    Route::get("init/{json_file}/{user_refid}",[Project\FoxcityFood\Init::class, 'init']);
});