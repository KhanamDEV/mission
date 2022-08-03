<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 14:40
 */

namespace App\Repository\Admin\SystemNotify;

use Illuminate\Support\Facades\DB;

class SystemNotificationRepository implements SystemNotificationRepositoryInterface
{

    const TABLE = 'system_notifies';

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function getList($_data)
    {
        $notifies = DB::table(self::TABLE)->orderBy('created_at', 'DESC');
        return isset($_data['perPage']) ? $notifies->paginate($_data['perPage']) : $notifies->get();
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}