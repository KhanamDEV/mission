<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 09:42
 */

namespace App\Repository\Api\User;


use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{

    const TABLE = 'users';

    public function checkHasUserByEmail($_email)
    {
        return DB::table(self::TABLE)
            ->where('email', '=', $_email)
            ->where('verified', '=', 1)
            ->count();
    }

    public function updateByEmail($_email, $_data)
    {
        return DB::table(self::TABLE)
            ->where('email', '=', $_email)
            ->update($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->where('id', '=', $_id)
            ->first();
    }

    public function update($_data, $_id)
    {
        return DB::table(self::TABLE)
            ->where('id', '=', $_id)
            ->update($_data);
    }

    public function getListByBrandId($_brand_id)
    {
        return DB::table(self::TABLE)
            ->where('brand_id', '=', $_brand_id)
            ->orderBy('id', 'ASC')
            ->get();
    }

    public function upNumberNotification($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update(['number_notification' => DB::raw('number_notification + 1'), 'updated_at' => date('Y-m-d H:i:s')]);
    }
}