<?php

namespace App\Repository\User\UserLogin;

use Illuminate\Support\Facades\DB;

class UserLoginRepository implements UserLoginRepositoryInterface
{

    const TABLE = 'user_logins';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->count() ?
            DB::table(self::TABLE)->where('user_id', $_user_id)->delete() : true;
    }
}