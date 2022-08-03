<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 9:19 AM
 **/


namespace App\Service\Admin\Auth;


use App\Mail\ForgetPasswordAdminMail;
use App\Repository\Admin\Brand\BrandRepositoryInterface;
use App\Repository\Admin\User\UserRepositoryInterface;
use App\Repository\PasswordReset\PasswordResetRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordService
{

    private $brandRepository;
    private $passwordResetRepository;

    public function __construct(BrandRepositoryInterface $brandRepository, PasswordResetRepositoryInterface $passwordResetRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function findByEmail($email)
    {
        return $this->brandRepository->checkHasAccount($email);
    }

    public function sendConfirmMail($data)
    {
        DB::beginTransaction();
        try {
            $token = sha1($data['email'] . date('Y/m/d H:i:s'));

            $dataInsert = [
                'email' => $data['email'],
                'token' => $token,
                'type' => 'web',
                'user_type' => 'admin',
                'created_at' => date('Y/m/d H:i:s')
            ];
            if(!$this->passwordResetRepository->create($dataInsert)){
                DB::rollBack();
                return false;
            }

            Mail::to($data['email'])->send(new ForgetPasswordAdminMail(['email' => $data['email'], 'token' => $token]));
            if (Mail::failures()) {
                DB::rollBack();
                return false;
            }
            DB::commit();
            return $token;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }

    public function getByTokenValid($token)
    {
        $data = [
            'token' => $token,
            'type' => 'web',
            'user_type' => 'admin'
        ];
        $dataResetPassword = $this->passwordResetRepository->getByTokenValid($data);
        if (empty($dataResetPassword)) return false;
        return $dataResetPassword->status ? false : true;
    }

    public function changePassword($data)
    {
        DB::beginTransaction();
        try {
            $dataConfirmPassword = [
                'token' => $data['token'],
                'type' => 'web',
                'user_type' => 'admin',
            ];
            $dataPassword = $this->passwordResetRepository->getByTokenValid($dataConfirmPassword);
            if (empty($dataPassword)) return false;
            $dataUpdateBrand = [
                'password' => Hash::make($data['password']),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (!$this->brandRepository->updateByEmail($dataPassword->email, $dataUpdateBrand)) {
                DB::rollBack();
                return false;
            }
            if (!$this->passwordResetRepository->changeStatusByToken($data['token'])) {
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            return false;
        }
    }
}