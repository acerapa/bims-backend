<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

  Route::group(['prefix' => 'plugin_config'], function () {
    Route::get('file/{filepath}', [\App\Http\Controllers\plugin_config\ConfigFile::class, 'file']);
  });

  Route::group(['prefix' => 'plugin_inquiry'], function () {
    Route::get('postInquiry', [\App\Http\Controllers\plugin_inquiry\Inquiry::class, 'postInquiry']);
  });
  
  Route::group(['prefix' => 'plugin_tagging'], function () {
    Route::get('action/{action}/{type}/{primary}/{secondary}/{created_by}', [\App\Http\Controllers\plugin_tagging\Tagging::class, 'action']);
  });
  
  Route::group(['prefix' => 'plugin_photo'], function () {
    Route::get('saveInfoTemp', [\App\Http\Controllers\plugin_photo\Photos::class, 'saveInfoTemp']);
    Route::get('saveInfoVerify', [\App\Http\Controllers\plugin_photo\Photos::class, 'saveInfoVerify']);
    Route::get('tagFixer', [\App\Http\Controllers\plugin_photo\Photos::class, 'tagFixer']);
    Route::get('getPhotos', [\App\Http\Controllers\plugin_photo\Photos::class, 'getPhotos']);
    Route::get('updateTaggedCover/{table}/{column}/{photo_refid}', [\App\Http\Controllers\plugin_photo\Photos::class, 'updateTaggedCover']);
    Route::get('removeTag/{photo_refid}/{tagged}', [\App\Http\Controllers\plugin_photo\Photos::class, 'removeTag']);
    Route::get('delete/{photo_refid}', [\App\Http\Controllers\plugin_photo\Photos::class, 'delete']);
    Route::get('photoTagging/{photo_refid}/{package_refid}/{created_by}', [\App\Http\Controllers\plugin_photo\Photos::class, 'photoTagging']);
  });
  
  Route::group(['prefix' => 'plugin_email_pass_auth_otp'], function () {
    Route::get('authBasic', [\App\Http\Controllers\plugin_email_pass_auth_otp\Authenticate::class, 'authBasic']);
    Route::get('authenticate', [\App\Http\Controllers\plugin_email_pass_auth_otp\Authenticate::class, 'auth']);
    Route::get('verifyOTP', [\App\Http\Controllers\plugin_email_pass_auth_otp\Authenticate::class, 'verifyOTP']);
    Route::get('authOnReopen', [\App\Http\Controllers\plugin_email_pass_auth_otp\Authenticate::class, 'authOnReopen']);
    Route::get('authLogout/{token}', [\App\Http\Controllers\plugin_email_pass_auth_otp\Authenticate::class, 'authLogout']);
    Route::get('confirmActionByPassword', [\App\Http\Controllers\plugin_email_pass_auth_otp\ConfirmActionByPassword::class, 'confirm']);
  });
  
  Route::group(['prefix' => 'plugin_twilio_sms'], function () {
    Route::get('SMS', [\App\Http\Controllers\plugin_twilio_sms\Send::class, 'SMS']);
  });
  
  Route::group(['prefix' => 'plugin_query'], function () {
    Route::get('isDataExist', [\App\Http\Controllers\plugin_query\IsExist::class, 'exist']);
    Route::get('insertGetId', [\App\Http\Controllers\plugin_query\Create::class, 'insertGetId']);
    Route::get('getRowPaginate', [\App\Http\Controllers\plugin_query\GetRowPaginate::class, 'get']);
    Route::get('getRowBasic/{table}/{getColumn}/{whereColumn}/{whereValue}', [\App\Http\Controllers\plugin_query\GetRowBasic::class, 'get']);
    Route::get('getRowMultiWhere', [\App\Http\Controllers\plugin_query\GetRowMultiWhere::class, 'get']);
    Route::get('getJoinTwoTablePaginate', [\App\Http\Controllers\plugin_query\GetJoinTwoTablePaginate::class, 'get']);
    Route::get('editMultiple', [\App\Http\Controllers\plugin_query\Edit::class, 'editMultiple']);
    Route::get('deletePermanent', [\App\Http\Controllers\plugin_query\Delete::class, 'deletePermanent']);
    Route::get('getTableSchema/{table}', [\App\Http\Controllers\plugin_query\Scheme::class, 'getTableSchema']);
  });
