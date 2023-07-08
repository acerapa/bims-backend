<?php

Route::group(['prefix' => 'foxcity_4_dashboard'], function () {
    Route::get("init",[Project\Foxcity4Dashboard\Dashboard::class, 'init']);
    Route::get("login",[Project\Foxcity4Dashboard\Login::class, 'login']);
});