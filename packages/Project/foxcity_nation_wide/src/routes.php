<?php

    Route::group(['prefix' => 'foxcity'], function () {
        /** RANDOM */
        Route::get("init",[Project\Foxcity\Init::class, 'fetch']);
        Route::get("storeProfile",[Project\Foxcity\StoreProfile::class, 'get']);
        Route::get("generateStoreProfiles",[Project\Foxcity\ScheduleTaskStore::class, 'generateStoreProfiles']);
        Route::get("userRegistrationClone",[Project\Foxcity\UserRegistrationClone::class, 'clone']);
        Route::get("mycartProfileLocal/{json_file}/{user_refid}/{store_refid}/{lat}/{lng}",[Project\Foxcity\MyCartProfile::class, 'local']);
        /** CLONE DATA START */
        Route::get("execute",[Project\Foxcity\CronJobs::class, 'execute']);
        Route::get("connection",[Project\Foxcity\CloneData::class, 'connection']);
        Route::get("fetchStores/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchStores']);
        Route::get("fetchStoresFixLogo",[Project\Foxcity\CloneData::class, 'fetchStoresFixLogo']);
        Route::get("fetchStoresFixCover",[Project\Foxcity\CloneData::class, 'fetchStoresFixCover']);
        Route::get("fetchProducts/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchProducts']);
        Route::get("fetchProductInitPrice/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchProductInitPrice']);
        Route::get("fetchProductPriceVariant/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchProductPriceVariant']);
        Route::get("fetchProductPriceFixed/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchProductPriceFixed']);
        Route::get("fetchStoresMenuGroup/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchStoresMenuGroup']);
        Route::get("fetchUsers/{from}/{to}",[Project\Foxcity\CloneData::class, 'fetchUsers']);
        /** CLONE DATA END */
    });