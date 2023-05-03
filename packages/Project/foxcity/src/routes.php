<?php

    Route::group(['prefix' => 'foxcity'], function () {
        Route::get('test', function () {
            echo "Test";
        });
    });