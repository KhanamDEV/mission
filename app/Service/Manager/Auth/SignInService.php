<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 17/05/2021
 * Time: 9:48 AM
 **/


namespace App\Service\Manager\Auth;


use Illuminate\Support\Facades\Auth;

class SignInService
{
    public function signIn($data){
        return Auth::guard('manager')->attempt(['email' => $data['email'], 'password' => $data['password']]);
    }
}