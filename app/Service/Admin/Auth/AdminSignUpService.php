<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 1:02 PM
 **/


namespace App\Service\Admin\Auth;


use App\Mail\SignUpAdminMail;
use App\Repository\Admin\Brand\BrandRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminSignUpService
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $blandRepository)
    {
        $this->brandRepository = $blandRepository;
    }

    public function signUp($data)
    {
        if (!$this->brandRepository->checkHasAccount($data['email'])) {
            $dataInsert = [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'verified' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            return $this->brandRepository->create($dataInsert);
        } else {
           return false;
        }
    }

    public function checkHasVerificationCode($verification_code)
    {
        return empty($this->brandRepository->checkHasVerificationCode($verification_code));
    }

    public function activeByVerificationCode($verification_code)
    {
        return $this->brandRepository->activeByVerificationCode($verification_code);
    }

}