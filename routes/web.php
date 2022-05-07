<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace' => 'Front'], function () {

    Route::get('/result/{result_code}', 'PagesController@patient_result')->name('patient_result');

    Route::GET('/result.php', 'PagesController@result_search')->name('/result.php');
});


Route::get('/home', 'Front\HomeController@home')->name('home');
Route::get('/', 'Front\HomeController@secondHome')->name('secondHome');


Route::get('/nav_app_features', 'Front\HomeController@nav_app_features')->name('nav_app_features');
/*  Country - State */
Route::get('/frontGetState',      [HomeController::class, 'frontGetState'    ])->name('frontend.frontGetState');
Route::any('/getCities/{country}', function ($country) {
    $country_id = \App\Models\Country::where('name', $country)->pluck("id");
    $list_cities = \App\Models\State::where('country_id', $country_id)->pluck("name", "id");
    return $list_cities;
});

 //==============================Translate all pages============================
Route::group(
    [
        'middleware' => ['auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //============================== Admins ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('admins', 'AdminController');
    });
    //============================== Users ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('users', 'UserController');
    });
    //============================== Members ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('members', 'MemberController');

        Route::GET('/show_male_members', 'MemberController@show_male_members')->name('show_male_members');
        Route::GET('/show_female_members', 'MemberController@show_female_members')->name('show_female_members');
        Route::GET('/show_filter_page', 'MemberController@show_filter_page')->name('show_filter_page');
        Route::GET('members_filter_search', 'MemberController@member_filter_search')->name('members_filter_search');

    });

    //============================== Jobs ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('member_inboxs', 'Member_InboxController');

        Route::get('/member/show_member_inboxs/{id}', 'Member_InboxController@show_member_inboxs');
        Route::post('/member_inbox/visible', 'Member_InboxController@member_inbox_visible')->name('/member_inbox/visible');
        Route::post('/member_inbox/read', 'Member_InboxController@member_inbox_read')->name('/member_inbox/read');

    });

    //============================== Common Questions ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('common_questions', 'Common_QuestionController');
        Route::post('common_question/visible', 'Common_QuestionController@common_question_visible')->name('common_question/visible');
    });
    //============================== About US ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('aboutus', 'AboutusController');
    });
    //============================== Privacy && Rules ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('privacy', 'PrivacyController');
        Route::post('show_privacy/visible', 'PrivacyController@privacy_visible')->name('show_privacy/visible');

        Route::resource('rule', 'RuleController');
        Route::post('show_rule/visible', 'RuleController@rule_visible')->name('show_rule/visible');
    });

    //============================== News ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('news', 'NewsController');
    });

    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('company_location', 'Company_LocationController');
    });

    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('countries', 'CountryController');
    });

    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('states', 'StateController');
    });
    //============================== Social Mail ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('socials', 'Social_MailController');
        Route::post('socials/visible', 'Social_MailController@socials_visible')->name('socials/visible');
    });
    //============================== contacts  ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('contacts', 'ContactController');
        Route::post('contact/visible', 'ContactController@contact_visible')->name('contact/visible');
    });


    //============================== App Feature ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('app_features', 'App_FeatureController');
        Route::post('app_features/visible', 'App_FeatureController@app_feature_visible')->name('app_features/visible');
    });
    //============================== Homepage Words ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('homepage_words', 'Homepage_WordController');
        Route::post('homepage_words/visible', 'Homepage_WordController@homepage_words_visible')->name('homepage_words/visible');
    });

    //============================== Homepage Words ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('success_relations', 'Success_RelationController');
        Route::post('success_relations/visible', 'Success_RelationController@success_relations_visible')->name('success_relations/visible');
    });
    //============================== Homepage Words ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('advs', 'AdvController');
        Route::post('advs/visible', 'AdvController@advs_visible')->name('advs/visible');
    });
    //============================== packages ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('packages', 'PackageController');
        Route::post('packages/visible', 'PackageController@packages_visible')->name('packages/visible');
    });

    //============================== package_features ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('package_features', 'Package_FeatureController');

        Route::get('/package/show_package_features/{id}', 'Package_FeatureController@show_package_features');
        Route::post('/package_features/visible',          'Package_FeatureController@package_features_visible')->name('/package_features/visible');

    });








    //============================== App Routes Words ============================
    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('app_homepages', 'App\AppHomepagesController');
    });
    //============================== ًwebsite Logo And Name ============================
    Route::group(['namespace' => 'Admin'], function () {
        Route::resource('website_banner', 'App\WebsiteBannerController');
    });
    // //============================== Galleries/Slider ============================
    Route::group(['namespace' => 'admin'], function () {

        Route::resource('sliders', 'SliderController');
        Route::post('/sliders/first_slider', 'SliderController@first_slider')->name('sliders/first_slider');

    });

});




        Route::get('/getNotificationsNumber',   'MemberController@number')->name('notifications.number');
        Route::get('/getMessagesNumber'     ,   'Front\Member_RelationController@number')->name('/getMessagesNumber');


        Route::GET('/login_page',           'MemberController@show_login_page')->name('login_page');
        Route::post('/member_login',        'MemberController@member_login')->name('member_login');
        Route::get('/member_signout',       'MemberController@member_signout')->name('member_signout');
        Route::post('/member_give_like',    'MemberController@member_give_like')->name('member_give_like');
        Route::GET('/member_care',          'MemberController@member_care')->name('member_care');
        Route::POST('/member_block',        'MemberController@member_give_block')->name('member_block');
        Route::GET('/my_block_list',        'MemberController@my_block_list')->name('my_block_list');
        Route::GET('/who_visit_myprofile',  'MemberController@who_visit_myprofile')->name('who_visit_myprofile');

Route::GET('/online_members',       'MemberController@online_members')->name('online_members');
Route::GET('/online_male_members',  'MemberController@online_male_members')->name('online_male_members');
Route::GET('/online_female_members','MemberController@online_female_members')->name('online_female_members');
        Route::GET('/my_notifications_page','MemberController@my_notifications_page')->name('my_notifications_page');
Route::GET('/top_members_page',     'MemberController@top_members_page')->name('top_members_page');
        Route::post('/read_my_message',     'MemberController@read_my_message')->name('/read_my_message');



Route::group(['namespace' => 'Front'], function () {

            Route::GET('/rules_page',                           'Sofia_FrontController@show_rules_page')->name('rules_page');
            Route::GET('/privacy_page',                         'Sofia_FrontController@show_privacy_page')->name('privacy_page');
            Route::GET('/common_question_page',                 'Sofia_FrontController@show_common_question_page')->name('common_question_page');
            Route::GET('/search_common_question',               'Sofia_FrontController@search_common_question')->name('search_common_question');
            Route::GET('/about_sofia_page',                     'Sofia_FrontController@show_about_sofia_page')->name('about_sofia_page');

            Route::GET('/successful_stories',                   'Sofia_FrontController@successful_stories')->name('successful_stories');
            Route::GET('/latest_members',                 'Sofia_FrontController@latest_members')->name('latest_members');
            Route::GET('/latest_males',                   'Sofia_FrontController@latest_males')->name('latest_males');
            Route::GET('/latest_females',                 'Sofia_FrontController@latest_females')->name('latest_females');
            Route::GET('/contact_us_page',                      'Sofia_FrontController@show_contact_us_page')->name('contact_us_page');
            Route::POST('/send_message_from_front',             'Sofia_FrontController@send_message_from_front')->name('send_message_from_front');


            Route::GET('/health_members_index',           'Sofia_FrontController@health_members_index')->name('health_members_index');
            Route::GET('/health_members',                 'Sofia_FrontController@health_members')->name('health_members');



    // Route::GET('/login_page',                           'Login_FrontController@show_login_page')->name('login_page');
    // Route::GET('front_logout',                          'Login_FrontController@front_logout')->name('front_logout');
    // Route::POST('front_sign',                           'Login_FrontController@front_sign')->name('front_sign');


    //My Profile
            Route::GET('/myprofile_page',                       'Member_DataController@show_myprofile_page')->name('myprofile_page');
            Route::GET('/edit_myprofile_page',                  'Member_DataController@show_edit_myprofile_page')->name('edit_myprofile_page');
            Route::post('/member_update_profile/{id}',          'Member_DataController@member_update_profile')->name('member_update_profile');
            Route::GET('/forget_password_page',                 'Member_DataController@show_forget_password_page')->name('forget_password_page');

    //Login && Register
            Route::GET('/male_register_page',                   'Member_DataController@show_male_register_page')->name('male_register_page');
            Route::GET('/female_register_page',                 'Member_DataController@show_female_register_page')->name('female_register_page');
            Route::POST('/member_register',                     'Member_DataController@member_register')->name('member_register');

            Route::GET('/login_success_page',                   'Member_DataController@show_login_success_page')->name('login_success_page');
    Route::GET('/mysettings_page',                      'Member_DataController@show_mysettings')->name('show_mysettings');
    Route::POST('/update_mysettings',                    'Member_DataController@update_mysettings')->name('update_mysettings');

    //search
            Route::GET('/search_full_page',                     'Sofia_FrontController@show_search_full_page')->name('search_full_page');
            Route::GET('front_male_members_filter_search',      'Sofia_FrontController@front_male_members_filter_search')->name('front_male_members_filter_search');
            Route::GET('front_female_members_filter_search',    'Sofia_FrontController@front_female_members_filter_search')->name('front_female_members_filter_search');
            Route::GET('front_member_name_filter_search',       'Sofia_FrontController@front_member_name_filter_search')->name('front_member_name_filter_search');
            Route::GET('front_members_full_filter_search',      'Sofia_FrontController@front_members_full_filter_search')->name('front_members_full_filter_search');
            Route::GET('/stories-search',                        'Sofia_FrontController@storySearch')->name('stories-search');


            Route::GET('/show_member_details_page/{id}',        'Member_DataController@show_member_details_page');
            Route::POST('/member_message_to_member',            'Member_RelationController@member_message_to_member')->name('member_message_to_member');

            Route::GET('/my_data_page',                         'Member_RelationController@show_my_data_page')->name('my_data_page');
            Route::GET('/my_inbox_message_page',                'Member_RelationController@show_my_inbox_message_page')->name('my_inbox_message_page');
            // Route::GET('/old_inbox_message_page',               'Member_RelationController@old_inbox_message_page')->name('old_inbox_message_page');



    //search
            Route::GET('/package_index',                        'PackageController@package_index')->name('package_index');
            Route::GET('/package/front_package_features/{id}',  'PackageController@front_package_features');




});














// //Clear Cache facade value:
// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     return '<h1>Cache facade value cleared</h1>';
// });

// //Reoptimized class loader:
// Route::get('/optimize', function() {
//     $exitCode = Artisan::call('optimize');
//     return '<h1>Reoptimized class loader</h1>';
// });

// //Route cache:
// Route::get('/route-cache', function() {
//     $exitCode = Artisan::call('route:cache');
//     return '<h1>Routes cached</h1>';
// });

// //Clear Route cache:
// Route::get('/route-clear', function() {
//     $exitCode = Artisan::call('route:clear');
//     return '<h1>Route cache cleared</h1>';
// });

// //Clear View cache:
// Route::get('/view-clear', function() {
//     $exitCode = Artisan::call('view:clear');
//     return '<h1>View cache cleared</h1>';
// });

// //Clear Config cache:
// Route::get('/config-cache', function() {
//     $exitCode = Artisan::call('config:cache');
//     return '<h1>Clear Config cleared</h1>';
// });


//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
