<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 9:43 AM
 **/


namespace App\Repository\PasswordReset;


use Illuminate\Support\Facades\DB;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{

    const TABLE = 'password_resets';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getByTokenValid($_data)
    {
        return DB::table(self::TABLE)
            ->where('token', $_data['token'])
            ->where('type', $_data['type'])
            ->where('user_type', $_data['user_type'])
            ->when(isset($_data['email']), function ($query) use ($_data){
                return $query->where('email', '=', $_data['email']);
            })
            ->orderBy('id', 'DESC')
            ->first();
    }

    public function changeStatusByToken($_token)
    {
        return DB::table(self::TABLE)
            ->where('token', $_token)
            ->update(['status' => 1]);
    }

    public function getEmailNotConfirm($_email, $_type)
    {
        return DB::table(self::TABLE)
            ->where('email', $_email)
            ->where('type', $_type)
            ->where('status', 0)
            ->first();
    }
}