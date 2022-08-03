<?php

namespace App\Repository\User\UserLogin;

interface UserLoginRepositoryInterface
{
    public function store($_data);

    public function deleteByUserId($_user_id);

}