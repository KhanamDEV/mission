<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 5:13 PM
 **/


namespace App\Service\Admin\Auth;


use Illuminate\Support\Facades\Auth;

class AdminSignInService
{
    public function signIn($data){
        return Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'verified' => 1]);
    }
}