<?php

Route::group(['prefix' => 'foxcity_food'], function () {
    Route::get("init", function () {
        return [
            "success" => true
        ];
    });
});