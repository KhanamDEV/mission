<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 21/05/2021
 * Time: 2:32 PM
 **/


namespace App\Service\Api;


use App\Helpers\Helpers;
use App\Mail\ForgetPasswordAdminMail;
use App\Mail\ForgetPasswordUserMail;
use App\Repository\Api\Brand\BrandRepositoryInterface;
use App\Repository\Api\User\UserRepositoryInterface;
use App\Repository\PasswordReset\PasswordResetRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordService
{

    private $passwordResetRepository;
    private $userRepository;

    public function __construct(PasswordResetRepositoryInterface $passwordResetRepository,UserRepositoryInterface $userRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
        $this->userRepository = $userRepository;
    }

    public function checkHasUserByEmail($email){
        return $this->userRepository->checkHasUserByEmail($email);
    }

    public function confirmMail($data){
        DB::beginTransaction();
        try {
            $token = Helpers::generateTokenResetPassword();
            $dataInsert = [
                'email' => $data['email'],
                'token' => $token,
                'user_type' => 'user',
                'type' => 'mobile',
                'created_at' => date('Y/m/d H:i:s')
            ];
            if (!$this->passwordResetRepository->create($dataInsert)){
                DB::rollBack();
                return false;
            }
            Mail::to($data['email'])->send(new ForgetPasswordUserMail(['email' => $data['email'], 'token' => $token], 'mobile'));
            if (Mail::failures()){
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function confirmToken($data){
        $dataConfirm = [
            'token' => $data['token'],
            'email' => $data['email'],
            'type' => 'mobile',
            'user_type' => 'user'
        ];
        $dataResetPassword = $this->passwordResetRepository->getByTokenValid($dataConfirm);
        if (empty($dataResetPassword)) return ['status' => false, 'message' => __('api::message.user.input_wrong_token_change_password')];
        if(strtotime(date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($dataResetPassword->created_at)))) < strtotime(date('Y-m-d H:i:s'))){
            return [
                'status' => false,
                'message' => __('api::message.user.token_expired')
            ];
        }
        return ['status' => true];
    }

    public function changePassword($data){
        DB::beginTransaction();
        try {
            $dataUpdate = [
                'password' => Hash::make($data['password']),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (!$this->userRepository->updateByEmail($data['email'], $dataUpdate)){
                DB::rollBack();
                return false;
            }
            if (!$this->passwordResetRepository->changeStatusByToken($data['token'])){
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }
}