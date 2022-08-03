<?php

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

Route::prefix('brand')->group(function () {
    //sign-in
    Route::get('sign-in', 'Auth\SignInController@signIn')->name('admin.sign_in');
    Route::post('sign-in', 'Auth\SignInController@postSignIn');


    //forget-password
    Route::prefix('forget-password')->group(function () {
        Route::get('', 'Auth\PasswordController@confirmMail')->name('admin.forget_password');
        Route::post('', 'Auth\PasswordController@postConfirmMail');
        Route::get('confirm', 'Auth\PasswordController@confirm')->name('admin.forget_password_confirm');
        Route::get('change/{token}', 'Auth\PasswordController@change')->name('admin.change_password');
        Route::post('change/{token}', 'Auth\PasswordController@postChange');
    });

    //sign-up
//    Route::prefix('sign-up')->group(function () {
//        Route::get('', 'Auth\SignUpController@signUp');
//        Route::post('', 'Auth\SignUpController@postSignUp');
//        Route::get('confirm', 'Auth\SignUpController@confirm')->name('admin.sign_up_confirm');
//        Route::get('confirm-success', 'Auth\SignUpController@confirmSuccess')->name('admin.sign_up_confirm_success');
//    });

    Route::middleware(['admin'])->group(function (){
        Route::get('', 'BrandController@index');

        Route::prefix('user')->group(function () {
            Route::get('', 'UserController@index')->name('admin.user_index');
            Route::get('create', 'UserController@create')->name('admin.user_create');
            Route::post('create', 'UserController@store');
            Route::get('update', 'UserController@edit')->name('admin.user_edit');
            Route::post('update', 'UserController@update');
            Route::get('{id}/show', 'UserController@show')->name('admin.user_show');
            Route::get('{user_id}/mission/{id}', 'UserController@mission')->name('admin.user_mission');
            Route::get('{user_id}/system-notification/{id}/show', 'UserController@showSystemNotification')->name('admin.user_system_notification');
            Route::get('{user_id}/system-notification', 'UserController@getSystemNotification')->name('admin.user_system_notification_index');
            Route::get('{user_id}/brand-notification', 'UserController@getBrandNotification')->name('admin.user_brand_notification_index');
            Route::get('{user_id}/brand-notification/{id}/show', 'UserController@showBrandNotification')->name('admin.user_brand_notification');
            Route::post('{id}/delete','UserController@destroy')->name('admin.user_delete');
        });

        Route::prefix('team')->group(function () {
            Route::get('', 'TeamController@index')->name('admin.team_index');
            Route::get('/show/{id}', 'TeamController@show')->name('admin.team_show');
        });

        Route::prefix('program')->group(function () {
            Route::get('', 'ProgramController@index')->name('admin.program_index');
            Route::get('show/{id}', 'ProgramController@show')->name('admin.program_show');
        });

        Route::prefix('notification')->group(function (){
            Route::get('', 'NotificationController@index')->name('admin.notification_index');
            Route::get('{id}/show', 'NotificationController@show')->name('admin.notification_show');
            Route::get('{id}/edit', 'NotificationController@edit')->name('admin.notification_edit');
            Route::post('{id}/edit', 'NotificationController@update');
            Route::post('delete', 'NotificationController@destroy')->name('admin.notification_delete');
            Route::get('create', 'NotificationController@create')->name('admin.notification_create');
            Route::post('create', 'NotificationController@store');
        });

        Route::get('sign-out', 'Auth\SignInController@signOut')->name('admin.sign_out');
    });
});
