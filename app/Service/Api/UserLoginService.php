<?php

namespace App\Service\Api;

use App\Repository\Api\UserLogin\UserLoginRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLoginService
{
    private $userLoginRepository;

    public function __construct(UserLoginRepositoryInterface $userLoginRepository)
    {
        $this->userLoginRepository = $userLoginRepository;
    }

    public function store(){
        $dataInsert = [
            'user_id' =>JWTAuth::user()->id,
            'device' => 'mobile',
            'logined_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->userLoginRepository->store($dataInsert);
    }
}