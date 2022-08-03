<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 4:30 PM
 **/


namespace App\Service\User\Auth;


use App\Mail\SignUpUserMail;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SignUpService
{
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp($data)
    {
        DB::beginTransaction();
        try {
            $token = sha1(date('Y/m/d H:i:s') . $data['email']);
            if ($this->userRepository->checkHasAccount($data['email'])) {
                $dataUpdate = [
                    'verification_code' => $token,
                    'password' => Hash::make($data['password']),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if (!$this->userRepository->updateByEmail($data['email'], $dataUpdate)) {
                    DB::rollBack();
                    return false;
                }
            } else {
                $dataInsert = [
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'verification_code' => $token,
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                ];
                if (!$this->userRepository->create($dataInsert)) {
                    DB::rollBack();
                    return false;
                }
            }
            $dataMail = [
                'email' => $data['email'],
                'token' => $token
            ];
            Mail::to($dataMail['email'])->send(new SignUpUserMail($dataMail));
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

    public function checkHasVerificationCode($verification_code)
    {
        return empty($this->userRepository->checkHasVerificationCode($verification_code));
    }

    public function activeByVerificationCode($verification_code)
    {
        return $this->userRepository->activeByVerificationCode($verification_code);
    }
}