<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Member_Auth_ApiController;

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


//Routes That Any One Can Access Without Any Condition
Route::group(['middleware' => 'api', 'namespace' => 'Api' ], function () {

    Route::get('/get_location_whats_map',   'FrontController@get_location_whats_map')->name('get_location_whats_map');
    Route::get('/get_all_social_media',     'FrontController@get_all_social_media')->name('get_all_social_media');
    Route::get('/get_all_common_question',  'FrontController@get_all_common_question')->name('get_all_common_question');
    Route::get('/get_aboutus',              'FrontController@get_aboutus')->name('get_aboutus');
    Route::get('/get_all_privacy',          'FrontController@get_all_privacy')->name('get_all_privacy');
    Route::get('/get_all_rule',             'FrontController@get_all_rule')->name('get_all_rule');
    Route::get('/get_all_news',             'FrontController@get_all_news')->name('get_all_news');
    Route::get('/get_all_news',             'FrontController@get_all_news')->name('get_all_news');

    Route::get('/get_home_info',            'FrontController@get_home_info')->name('get_home_info');
    Route::get('/get_app_features',         'FrontController@get_app_features')->name('get_app_features');
    Route::get('/get_package',              'FrontController@get_package')->name('get_package');
    Route::get('/get_package_features',     'FrontController@get_package_features')->name('get_package_features');
    Route::get('/get_countries',            'FrontController@get_countries')->name('get_countries');
    Route::get('/get_cities',               'FrontController@get_cities')->name('get_cities');
    Route::GET('/get_logo_name',            'FrontController@get_logo_name')->name('get_logo_name');
    Route::GET('/get_homepages',            'FrontController@get_homepages')->name('get_homepages');


});





Route::post('member_register', 'Member_Auth_ApiController@member_register')->name('member_register');

Route::post('forgot-password', [Member_Auth_ApiController::class,"forgotPassword"]);
Route::post('reset-password', [Member_Auth_ApiController::class,"resetPassword"]);


Route::group(['middleware' => ['api'], 'namespace' => 'Api' ], function () {
    //Login && Register
    Route::post('member_login', 'Member_Auth_ApiController@member_login')->name('member_login');
    Route::post('member_logout','Member_Auth_ApiController@member_logout')->middleware(['auth.guard:member_api']);
    Route::post('member_register', 'Member_Auth_ApiController@member_register')->name('member_register');

    //////
    Route::post('register_name_1', 'Member_Auth_ApiController@register_name_1')->name('register_name_1');


    //Get Members
    // Route::GET('/get_all_members', 'Member_ApiController@get_all_members')->name('get_all_members');
    // Route::GET('/get_one_country_members', 'Member_ApiController@getOnCountryMembers')->name('get_one_country_members');
    Route::post('change_member_status', 'Member_ApiController@change_member_status');
    // Route::get('get_new_members',           'Member_ApiController@get_new_members');



    //Auth Member Routes
    Route::group(['middleware' => 'auth.guard:member_api'], function () {

        //Registeration
        Route::post('register_select_2', 'Member_Auth_ApiController@register_select_2')->name('register_select_2');
        Route::post('register_text_3', 'Member_Auth_ApiController@register_text_3')->name('register_text_3');
        Route::post('update_image', 'Member_Auth_ApiController@update_image')->name('update_image');


        Route::get('get_auth_id',               'Member_ApiController@get_auth_id');
        Route::GET('get_member_byId', 'Member_ApiController@get_member_byId');
        Route::post('update_profile_data', 'Member_Auth_ApiController@updateProfileData');
        Route::post('new_password', 'Member_Auth_ApiController@newPassword');


        Route::get('get_notification_status',        'Member_ApiController@get_notification_status');
        Route::post('change_notification_status',        'Member_ApiController@change_notification_status');
        Route::post('update_notifications_settings',        'Member_ApiController@update_notifications_settings');

        Route::get('get_online_members',        'Member_ApiController@get_online_members');
        Route::get('get_my_notifications',      'Member_ApiController@get_my_notifications');
        Route::get('get_member_care_me',        'Member_ApiController@get_member_care_me');
        Route::get('my-favourite-list',        'Member_ApiController@myFavouriteList');
        Route::get('my-block-list',        'Member_ApiController@myBlockList');

        Route::get('get_member_block_me',       'Member_ApiController@get_member_block_me');
        Route::get('get_member_visit_myprofile','Member_ApiController@get_member_visit_myprofile');
        Route::POST('give_like',                 'Member_ApiController@give_like');
        Route::POST('give_block',                'Member_ApiController@give_block');
        Route::get('show_my_inbox_message',    'Member_ApiController@show_my_inbox_message');
        
        //2022
        Route::GET('/get_all_members', 'Member_ApiController@get_all_members');
        Route::GET('/get_one_country_members', 'Member_ApiController@getOnCountryMembers');
        Route::get('get_new_members',           'Member_ApiController@get_new_members');
        Route::get('my_inbox_messages',           'Member_ApiController@my_inbox_messages');
        Route::post('delete_inbox_messages',           'Member_ApiController@delete_inbox_messages');
        Route::get('auth_member',           'Member_ApiController@authMember');
        Route::get('member_name_search',           'Member_ApiController@member_name_search');
        Route::get('member_full_search',           'Member_ApiController@member_full_search');
        Route::get('common_question_search',           'Member_ApiController@commonQuestionSearch');
        Route::get('get-health-members',           'Member_ApiController@getHealthMembers');
        Route::get('healthy-member-search',           'Member_ApiController@healthMemberSearch');
        
        //Chat Message
        Route::post('send-chat-message',        'ChatController@sendChatMessage');
        Route::get('get-chat-message',        'ChatController@getChatMessage');
        Route::post('delete-chat-message',        'ChatController@deleteChatMessage');
        Route::post('delete-all-chat',        'ChatController@deleteAllChat');
        Route::get('get-chat-members',        'ChatController@getChatMembers');
        //Suport Message
        Route::post('message-sofia-support',        'Member_ApiController@messageSofiaSupport');
        //Settings
        Route::post('add-country-can-text-me-settings',        'Member_ApiController@addCountryCanTextMeSettings');
        Route::get('get-country-can-text-me-settings',        'Member_ApiController@getCountryCanTextMeSettings');
        Route::post('delete-country-can-text-me-settings',        'Member_ApiController@deleteCountryCanTextMeSettings');

    });


    //Admin Routes
    Route::group(['prefix' => 'admin','namespace'=>'Admin'],function (){
        Route::post('admin_login',   'Admin_Auth_ApiController@admin_login')->name('admin_login');
        Route::post('admin_logout',  'Admin_Auth_ApiController@admin_logout')->middleware(['auth.guard:api']);
        Route::post('admin_register','Admin_Auth_ApiController@admin_register')->name('admin_register');
    });

});


Route::group(['middleware' => ['api','checkPassword','checkAdmin:member_api'], 'namespace' => 'Api'], function () {
    Route::get('offers', 'CategoriesController@index');
});
