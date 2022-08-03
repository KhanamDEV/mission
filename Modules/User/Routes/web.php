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

Route::prefix('user')->group(function() {

    Route::prefix('sign-in')->group(function (){
        Route::get('', 'Auth\SignInController@signIn')->name('user.sign_in');
        Route::post('', 'Auth\SignInController@postSignIn');
    });

    //forget-password
    Route::prefix('forget-password')->group(function () {
        Route::get('', 'Auth\PasswordController@confirmMail')->name('user.forget_password');
        Route::post('', 'Auth\PasswordController@postConfirmMail');
        Route::get('confirm', 'Auth\PasswordController@confirm')->name('user.forget_password_confirm');
        Route::get('change/{token}', 'Auth\PasswordController@change')->name('user.change_password');
        Route::post('change/{token}', 'Auth\PasswordController@postChange');
    });

    Route::middleware(['user'])->group(function (){

        Route::get('', 'UserController@index')->name('user.index');
        Route::get('show/{id}', 'UserController@show')->name('user.show');
        Route::get('{user_id}/mission/{id}', 'UserController@mission')->name('user.mission');
        Route::get('edit', 'UserController@edit')->name('user.edit');
        Route::post('edit', 'UserController@update');
        Route::post('delete/{id}', 'UserController@destroy')->name('user.delete');

        Route::prefix('team')->group(function (){
           Route::get('', 'TeamController@index')->name('user.team_index');
           Route::get('show/{id}', 'TeamController@show')->name('user.team_show');
        });

        Route::prefix('program')->group(function (){
           Route::get('', 'ProgramController@index')->name('user.program_index');
           Route::get('show/{id}', 'ProgramController@show')->name('user.program_show');
        });

        Route::get('sign-out', 'Auth\SignInController@signOut')->name('user.sign_out');
    });
});
