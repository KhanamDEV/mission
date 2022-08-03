<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 17/06/2021
 * Time: 09:33
 */

namespace App\Repository\User\LogUpdateUser;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogUpdateUserRepository implements LogUpdateUserRepositoryInterface
{
    const TABLE = 'log_update_users';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getList()
    {
        return DB::table(self::TABLE)->where('brand_id', Auth::guard('user')->user()->brand_id)->orderBy('created_at', 'DESC')->get();
    }
}