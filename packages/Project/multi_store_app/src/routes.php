<?php

    Route::group(['prefix' => 'multistoreapp'], function () {
        Route::get("init",function () {
            echo "Test";
        });
    });