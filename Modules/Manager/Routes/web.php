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

Route::prefix('admin')->group(function () {
    Route::get('sign-in', 'SignInController@signIn')->name('manager.sign_in');
    Route::post('sign-in', 'SignInController@postSignIn');

    Route::middleware(['manager'])->group(function () {
        Route::get('', 'ManagerController@index');

        Route::prefix('brand')->group(function () {
            Route::get('', 'BrandController@index')->name('manager.brand_index');
            Route::get('create', 'BrandController@create')->name('manager.brand_create');
            Route::post('create', 'BrandController@store');
            Route::get('show/{id}', 'BrandController@show')->name('manager.brand_show');
            Route::get('edit/{id}', 'BrandController@edit')->name('manager.brand_edit');
            Route::post('edit/{id}', 'BrandController@update');
            Route::get('{id}/menu', 'BrandController@menu')->name('manager.brand_menu');

            //user
            Route::get('{brand_id}/user', 'UserController@index')->name('manager.user_index');
            Route::prefix('{brand_id}/user')->group(function () {
                Route::get('create', 'UserController@create')->name('manager.user_create');
                Route::post('create', 'UserController@store');
                Route::get('edit', 'UserController@edit')->name('manager.user_edit');
                Route::post('edit', 'UserController@update');
                Route::get('show/{id}', 'UserController@show')->name('manager.user_show');
                Route::get('{user_id}/mission/{id}', 'UserController@showMission')->name('manager.user_mission_show');
                Route::prefix('{user_id}/brand-notification')->group(function (){
                   Route::get('', 'UserController@brandNotification')->name('manager.user_brand_notification');
                   Route::get('{id}/detail', 'UserController@brandNotificationDetail')->name('manager.user_brand_notification_detail');
                });
                Route::prefix('{user_id}/system-notification')->group(function (){
                    Route::get('', 'UserController@systemNotification')->name('manager.user_system_notification');
                    Route::get('{id}/detail', 'UserController@systemNotificationDetail')->name('manager.user_system_notification_detail');
                });
                Route::post('delete/{id}', 'UserController@destroy')->name('manager.user_delete');
            });

            //team
            Route::prefix('{brand_id}/team')->group(function () {
                Route::get('', 'TeamController@index')->name('manager.team_index');
                Route::get('/show/{id}', 'TeamController@show')->name('manager.team_show');
            });

            //notification
            Route::prefix('{brand_id}/notification')->group(function () {
                Route::get('/', 'NotificationController@index')->name('manager.notification_index');
                Route::get('/create', 'NotificationController@create')->name('manager.notification_create');
                Route::post('/create', 'NotificationController@store');
                Route::get('/{id}/show', 'NotificationController@show')->name('manager.notification_show');
                Route::get('/{id}/edit', 'NotificationController@edit')->name('manager.notification_edit');
                Route::post('/{id}/edit', 'NotificationController@update');
                Route::post('/delete', 'NotificationController@destroy')->name('manager.notification_delete');
            });
        });

        Route::prefix('mission-base')->group(function () {
            Route::get('', 'MissionBaseController@index')->name('manager.mission_base.index');
            Route::get('create', 'MissionBaseController@create')->name('manager.mission_base.create');
            Route::post('create', 'MissionBaseController@store')->name('manager.mission_base.store');
            Route::get('show/{id}', 'MissionBaseController@show')->name('manager.mission_base.show');
            Route::get('edit/{id}', 'MissionBaseController@edit')->name('manager.mission_base.edit');
            Route::post('edit/{id}', 'MissionBaseController@update')->name('manager.mission_base.update');
            Route::post('destroy/{id}', 'MissionBaseController@destroy')->name('manager.mission_base.destroy');
            Route::get('search', 'MissionBaseController@search')->name('manager.mission_base.search');
        });

        Route::prefix('program')->group(function () {
            Route::get('', 'ProgramController@index')->name('manager.program_index');
            Route::get('create', 'ProgramController@create')->name('manager.program_create');
            Route::post('create', 'ProgramController@store');
            Route::get('show/{id}', 'ProgramController@show')->name('manager.program_show');
            Route::get('edit/{id}', 'ProgramController@edit')->name('manager.program_edit');
            Route::post('edit/{id}', 'ProgramController@update');
        });

        Route::prefix('program-mission')->group(function () {
            Route::post('destroy', 'ProgramMissionController@destroy')->name('manager.program_mission_destroy');
        });

        Route::prefix('download')->group(function () {
            Route::get('', 'DownloadController@index')->name('manager.download_index');
            Route::get('get-csv', 'DownloadController@getCSV')->name('manager.download.get_csv');
        });

        Route::prefix('notify')->group(function () {
            Route::get('/', 'NoticeManagementController@index')->name('manager.notice_management_index');
            Route::get('/create', 'NoticeManagementController@create')->name('manager.notice_management_create');
            Route::post('/create', 'NoticeManagementController@store');
            Route::get('/{id}/show', 'NoticeManagementController@show')->name('manager.notice_management_show');
            Route::get('/{id}/edit', 'NoticeManagementController@edit')->name('manager.notice_management_edit');
            Route::post('/{id}/edit', 'NoticeManagementController@update');
            Route::post('/delete', 'NoticeManagementController@destroy')->name('manager.notice_management_delete');
        });

        //public data
        Route::get('/get-list-team-brand', 'TeamController@getListByBrand')->name('manager.team_get_list');
        Route::get('/get-list-user-brand', 'UserController@getListByBrand')->name('manager.user_get_list');

        Route::prefix('database')->group(function (){
            Route::get('/{table}', 'DatabaseController@index');
        });

        Route::get('sign-out', 'SignInController@signOut')->name('manager.sign_out');
    });
});
