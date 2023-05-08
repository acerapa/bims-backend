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

  Route::group(['prefix' => 'plugin_store'], function () {
      
  });

  Route::group(['prefix' => 'plugin_order_item'], function () {
    Route::get('add', [\App\Http\Controllers\plugin_order_item\Add::class, 'add']);
    Route::get('remove', [\App\Http\Controllers\plugin_order_item\Remove::class, 'remove']);
    Route::get('customerCancelOrder', [\App\Http\Controllers\plugin_order_item\CustomerCancelOrder::class, 'cancel']);
    Route::get('storeAcceptOrder', [\App\Http\Controllers\plugin_order_item\StoreAcceptOrder::class, 'accept']);
    Route::get('storeRefuseOrder', [\App\Http\Controllers\plugin_order_item\StoreRefuseOrder::class, 'refuse']);
    Route::get('storeSeenOrder', [\App\Http\Controllers\plugin_order_item\StoreSeenOrder::class, 'seen']);
  });

  Route::group(['prefix' => 'plugin_order_placed'], function () {
    Route::get('place', [\App\Http\Controllers\plugin_order_placed\CustomerPlaceOrder::class, 'place']);
  });

  Route::group(['prefix' => 'plugin_product'], function () {
    Route::get('create_init', [\App\Http\Controllers\plugin_product\Create::class, 'init']);
    Route::get('create_details', [\App\Http\Controllers\plugin_product\Create::class, 'details']);
  });

  Route::group(['prefix' => 'plugin_paynamics'], function () {
    Route::get('gcash', [\App\Http\Controllers\plugin_paynamics\PaymentGCash::class, 'send']);
    Route::get('send', [\App\Http\Controllers\plugin_paynamics\PaymentRequest::class, 'send']);
    Route::post('sale_post', [\App\Http\Controllers\plugin_paynamics\PaymentSale::class, 'post']);
  });

  Route::group(['prefix' => 'plugin_conversion'], function () {
    Route::get('hash_algos', [\App\Http\Controllers\plugin_conversion\HashEncode::class, 'hash_algos']);
    Route::get('hash_convert/{algo}/{string}', [\App\Http\Controllers\plugin_conversion\HashEncode::class, 'encode']);
    Route::get('string_to_base64_encode/{string}', [\App\Http\Controllers\plugin_conversion\StringToBase64Encode::class, 'encode']);
    Route::get('string_to_base64_decode/{string}', [\App\Http\Controllers\plugin_conversion\StringToBase64Decode::class, 'decode']);
  });

  Route::group(['prefix' => 'plugin_gps'], function () {
    Route::get('log_position', [\App\Http\Controllers\plugin_gps\LogPosition::class, 'log']);
    Route::get('get_last_position', [\App\Http\Controllers\plugin_gps\GetPosition::class, 'getLastPosition']);
  });

  Route::group(['prefix' => 'plugin_faq'], function () {
    Route::get('get', [\App\Http\Controllers\plugin_faq\FAQ::class, 'get']);
  });

  Route::group(['prefix' => 'plugin_chatbox'], function () {
    Route::get('create_user', [\App\Http\Controllers\plugin_chatbox\User::class, 'create']);
    Route::get('create_convo', [\App\Http\Controllers\plugin_chatbox\Convo::class, 'create']);
    Route::get('member_recepient', [\App\Http\Controllers\plugin_chatbox\Convo::class, 'addMemberRecepient']);
    Route::get('sendText', [\App\Http\Controllers\plugin_chatbox\MessageSend::class, 'sendText']);
  });

  Route::group(['prefix' => 'plugin_project_config'], function () {
    Route::get('setProjectEnv/{hostname}', [\App\Http\Controllers\plugin_project_config\Environment::class, 'setProjectEnv']);
    Route::get('setProjectEnvAuto', [\App\Http\Controllers\plugin_project_config\Environment::class, 'setProjectEnvAuto']);
    Route::get('gitInfo', [\App\Http\Controllers\plugin_project_config\Environment::class, 'gitInfo']);
  });

  Route::group(['prefix' => 'plugin_email'], function () {
    Route::get('sendText', [\App\Http\Controllers\plugin_email\SendBasic::class, 'sendText']);
    Route::get('sendHTML', [\App\Http\Controllers\plugin_email\SendBasic::class, 'sendHTML']);
  });

  Route::group(['prefix' => 'plugin_geography'], function () {
    Route::get('allRegion', [\App\Http\Controllers\plugin_geography\Config::class, 'allRegion']);
    Route::get('allProvince/{region_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allProvince']);
    Route::get('allCity/{province_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allCity']);
    Route::get('allBarangay/{city_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allBarangay']);
    Route::get('allActiveRegion', [\App\Http\Controllers\plugin_geography\Config::class, 'allActiveRegion']);
    Route::get('allActiveProvince/{region_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allActiveProvince']);
    Route::get('allActiveCity/{province_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allActiveCity']);
    Route::get('allActiveBarangay/{city_code}', [\App\Http\Controllers\plugin_geography\Config::class, 'allActiveBarangay']);
    Route::get('allActiveCityWithProvice', [\App\Http\Controllers\plugin_geography\Config::class, 'allActiveCityWithProvice']);
  });

  Route::group(['prefix' => 'plugin_blog'], function () {
    Route::get('create', [\App\Http\Controllers\plugin_blog\Create::class, 'create']);
    Route::get('getPaginate', [\App\Http\Controllers\plugin_blog\GetPaginate::class, 'get']);
    Route::get('getSingle', [\App\Http\Controllers\plugin_blog\GetSingle::class, 'get']);
    Route::get('delete/{blog_refid}', [\App\Http\Controllers\plugin_blog\Delete::class, 'delete']);
    Route::get('editDetails', [\App\Http\Controllers\plugin_blog\Edit::class, 'details']);
  });

  Route::group(['prefix' => 'plugin_inquiry_web_form'], function () {
    Route::get('send', [\App\Http\Controllers\plugin_inquiry_web_form\Send::class, 'send']);
    Route::get('getInquiries', [\App\Http\Controllers\plugin_inquiry_web_form\GetInquiries::class, 'get']);
    Route::get('delete/{inquiry_refid}', [\App\Http\Controllers\plugin_inquiry_web_form\Delete::class, 'delete']);
    Route::get('markAsDone', [\App\Http\Controllers\plugin_inquiry_web_form\MarkAsDone::class, 'done']);
  });

  Route::group(['prefix' => 'plugin_review'], function () {
    Route::get('create', [\App\Http\Controllers\plugin_review\Review::class, 'create']);
    Route::get('calculate', [\App\Http\Controllers\plugin_review\ScoreCalculator::class, 'calculate']);
    Route::get('getScore/{tag_primary}', [\App\Http\Controllers\plugin_review\Review::class, 'getScore']);
    Route::get('getFilteredReview', [\App\Http\Controllers\plugin_review\GetFilteredReview::class, 'get']);
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
    Route::get('getRowPaginateWhereIn', [\App\Http\Controllers\plugin_query\GetRowPaginate::class, 'getWhereIn']);
    Route::get('getRowBasic/{table}/{getColumn}/{whereColumn}/{whereValue}', [\App\Http\Controllers\plugin_query\GetRowBasic::class, 'get']);
    Route::get('getRowMultiWhere', [\App\Http\Controllers\plugin_query\GetRowMultiWhere::class, 'get']);
    Route::get('getJoinTwoTablePaginate', [\App\Http\Controllers\plugin_query\GetJoinTwoTablePaginate::class, 'get']);
    Route::get('editSingle', [\App\Http\Controllers\plugin_query\Edit::class, 'editSingle']);
    Route::get('editMultiple', [\App\Http\Controllers\plugin_query\Edit::class, 'editMultiple']);
    Route::get('deletePermanent', [\App\Http\Controllers\plugin_query\Delete::class, 'deletePermanent']);
    Route::get('deleteWithPassword', [\App\Http\Controllers\plugin_query\Delete::class, 'deleteWithPassword']);
    Route::get('getTableSchema/{table}', [\App\Http\Controllers\plugin_query\Scheme::class, 'getTableSchema']);
    Route::get('count', [\App\Http\Controllers\plugin_query\Count::class, 'count']);
    Route::get('sum', [\App\Http\Controllers\plugin_query\Sum::class, 'sum']);
  });

  Route::group(['prefix' => 'plugin_user'], function () {
    Route::get('changePassword', [\App\Http\Controllers\plugin_user\ChangePassword::class, 'change']);
    Route::get('getProfile/{user_refid}', [\App\Http\Controllers\plugin_user\GetProfile::class, 'get']);
    Route::get('register', [\App\Http\Controllers\plugin_user\Register::class, 'register']);
    Route::get('setTheme/{user_refid}/{theme}', [\App\Http\Controllers\plugin_user\Personalize::class, 'setTheme']);
  });

  

