<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 4:09 PM
 **/


namespace App\Repository\Admin\LogUpdateUser;


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
        return DB::table(self::TABLE)->where('brand_id', Auth::guard('admin')->user()->id)->orderBy('created_at', 'DESC')->get();
    }
}