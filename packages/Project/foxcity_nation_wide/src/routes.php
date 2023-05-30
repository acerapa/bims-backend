<?php

    Route::group(['prefix' => 'foxcity'], function () {
        Route::get("init",[Project\Foxcity\Init::class, 'fetch']);
        Route::get("storeProfile",[Project\Foxcity\StoreProfile::class, 'get']);
        Route::get("generateStoreProfiles",[Project\Foxcity\ScheduleTaskStore::class, 'generateStoreProfiles']);
        Route::get("userRegistrationClone",[Project\Foxcity\UserRegistrationClone::class, 'clone']);
        Route::get("mycartProfile/{json_file}/{user_refid}/{store_refid}",[Project\Foxcity\MyCartProfile::class, 'get']);
    });