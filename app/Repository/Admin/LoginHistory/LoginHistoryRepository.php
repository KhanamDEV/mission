<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 10:37
 */

namespace App\Repository\Admin\LoginHistory;

use Illuminate\Support\Facades\DB;

class LoginHistoryRepository implements LoginHistoryRepositoryInterface
{
    const TABLE = 'user_logins';

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->count() ?
            DB::table(self::TABLE)->where('user_id', $_user_id)->delete() : true;
    }
}