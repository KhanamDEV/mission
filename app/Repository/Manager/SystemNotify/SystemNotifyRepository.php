<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/11/2021
 * Time: 09:17
 */

namespace App\Repository\Manager\SystemNotify;

use Illuminate\Support\Facades\DB;

class SystemNotifyRepository implements SystemNotifyRepositoryInterface
{

    const TABLE = 'system_notifies';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }

    public function getList($_data)
    {
        $data = DB::table(self::TABLE)->orderBy('created_at', 'DESC');
        return isset($_data['perPage']) ? $data->paginate($_data['perPage']) : $data->get();
    }
}