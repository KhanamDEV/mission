<?php

use Illuminate\Http\Request;

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

Route::middleware(['api'])->group(function () {
    Route::prefix('v2')->group(function (){
        Route::post('sign-in', 'Auth\SignInController@postSignIn')->name('api.auth.sign_in');
        Route::get('single-page/{page}', 'SinglePageController@getContentPage')->name('api.single_page');
        Route::prefix('forget-password')->group(function () {
            Route::post('', 'Auth\PasswordController@confirmMail')->name('api.auth.confirm_mail');
            Route::post('confirm', 'Auth\PasswordController@confirmToken')->name('api.auth.confirm_token');
            Route::put('change', 'Auth\PasswordController@changePassword')->name('api.auth.change_password');
        });

        Route::middleware(['jwt.token'])->group(function () {
            Route::prefix('mission')->group(function () {
                Route::get('', 'MissionController@index');
                Route::get('question', 'MissionController@question');
                Route::post('question', 'MissionController@storeAnswerQuestion');
                Route::get('question-answered', 'MissionController@showQuestionAnswered');
                Route::put('edit-question-answered', 'MissionController@updateQuestionAnswered');
                Route::post('edit-question-answered', 'MissionController@updateQuestionAnswered');
            });

            Route::prefix('feedback')->group(function () {
                Route::get('', 'FeedbackController@index');
                Route::get('detail', 'FeedbackController@show');
            });

            Route::prefix('team')->group(function () {
                Route::get('', 'TeamController@index');
                Route::post('create', 'TeamController@store');
                Route::put('edit', 'TeamController@update');
                Route::get('detail', 'TeamController@detail');
                Route::put('edit-program', 'TeamController@updateProgram');
                Route::put('edit-member', 'TeamController@updateMember');
                Route::prefix('member')->group(function (){
                    Route::get('', 'TeamController@member');
                    Route::get('detail','TeamController@showMember');
                });
                Route::delete('/delete', 'TeamController@destroy');
            });

            Route::prefix('program')->group(function (){
                Route::get('', 'ProgramController@index');
                Route::get('detail', 'ProgramController@show');
            });

            Route::prefix('user')->group(function(){
                Route::get('', 'UserController@index');
                Route::get('detail', 'UserController@detail');
                Route::put('edit', 'UserController@update');
                Route::put('upload-avatar', 'UserController@updateAvatar');
                Route::put('update-push-notification-token', 'UserController@updatePushNotificationToken');
                Route::put('remove-push-notification-token', 'UserController@removePushNotificationToken');
                Route::post('send-notification', 'UserController@send');
                Route::get('get-push-token', 'UserController@getPushToken');
                Route::post('send-notification-daily', 'UserController@sendNotificationDaily');
                Route::put('reset-number-notification', 'UserController@resetNotification');
            });

            Route::prefix('notification')->group(function (){
                Route::get('', 'NotificationController@index');
                Route::get('detail', 'NotificationController@show');
            });

            Route::post('upload-image', 'UploadController@upload');
        });
    });
    Route::prefix('v1')->group(function (){
        Route::post('sign-in', 'Auth\SignInController@postSignIn')->name('api.auth.sign_in_v1');
        Route::get('single-page/{page}', 'SinglePageController@getContentPage')->name('api.single_page_v1');
        Route::prefix('forget-password')->group(function () {
            Route::post('', 'Auth\PasswordController@confirmMail')->name('api.auth.confirm_mail_v1');
            Route::post('confirm', 'Auth\PasswordController@confirmToken')->name('api.auth.confirm_token_v1');
            Route::put('change', 'Auth\PasswordController@changePassword')->name('api.auth.change_password_v1');
        });

        Route::middleware(['jwt.token'])->group(function () {
            Route::prefix('mission')->group(function () {
                Route::get('', 'MissionController@index');
                Route::get('question', 'MissionController@question');
                Route::post('question', 'MissionController@storeAnswerQuestion');
                Route::get('question-answered', 'MissionController@showQuestionAnswered');
                Route::put('edit-question-answered', 'MissionController@updateQuestionAnswered');
            });

            Route::prefix('feedback')->group(function () {
                Route::get('', 'FeedbackController@index');
                Route::get('detail', 'FeedbackController@show');
            });

            Route::prefix('team')->group(function () {
                Route::get('', 'TeamController@index');
                Route::post('create', 'TeamController@store');
                Route::put('edit', 'TeamController@update');
                Route::get('detail', 'TeamController@detail');
                Route::put('edit-program', 'TeamController@updateProgram');
                Route::put('edit-member', 'TeamController@updateMember');
                Route::prefix('member')->group(function (){
                    Route::get('', 'TeamController@member');
                    Route::get('detail','TeamController@showMember');
                });
                Route::delete('/delete', 'TeamController@destroy');
            });

            Route::prefix('program')->group(function (){
                Route::get('', 'ProgramController@index');
                Route::get('detail', 'ProgramController@show');
            });

            Route::prefix('user')->group(function(){
                Route::get('', 'UserController@index');
                Route::get('detail', 'UserController@detail');
                Route::put('edit', 'UserController@update');
                Route::put('upload-avatar', 'UserController@updateAvatar');
                Route::put('update-push-notification-token', 'UserController@updatePushNotificationToken');
                Route::put('remove-push-notification-token', 'UserController@removePushNotificationToken');
                Route::post('send-notification', 'UserController@send');
                Route::get('get-push-token', 'UserController@getPushToken');
                Route::post('send-notification-daily', 'UserController@sendNotificationDaily');

                Route::get('notify-count', 'UserController@getNotifyCount')->name('api.notify.get_count');
            });
            
            Route::post('upload-image', 'UploadController@upload');
            
            
        });
    });
});


