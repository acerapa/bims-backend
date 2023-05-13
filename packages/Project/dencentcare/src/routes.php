<?php

Route::group(['prefix' => 'dencentcare'], function () {
    Route::get("test", function () {
        echo "Tested";
    });
});