<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 18/05/2021
 * Time: 11:40 AM
 **/


namespace App\Repository\Manager\LogUpdateUser;


use Illuminate\Support\Facades\DB;

class LogUpdateUserRepository implements LogUpdateUserRepositoryInterface
{
    const TABLE = 'log_update_users';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getList($_data)
    {
        return DB::table(self::TABLE)->where('brand_id', $_data['brand_id'])->orderBy('created_at', 'DESC')->get();
    }
}