<?php

namespace App\Repository\Api\UserLogin;

use Illuminate\Support\Facades\DB;

class UserLoginRepository implements UserLoginRepositoryInterface
{

    const TABLE = 'user_logins';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }
}