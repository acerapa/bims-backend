<?php

Route::group(['prefix' => 'foxcity_4_dashboard'], function () {
    Route::get("test", function () {
        echo "Tested";
    });
});