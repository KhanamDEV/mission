<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 09:56
 */

namespace App\Repository\Api\Notification;

use Illuminate\Support\Facades\DB;

class BrandNotificationRepository implements BrandNotificationRepositoryInterface
{

    const TABLE = 'brand_notifies';

    public function getList($_data)
    {
        $notifies = DB::table(self::TABLE)
            ->where('brand_id', $_data['brand_id'])
            ->when(isset($_data['limit']), function ($query) use ($_data){
                return $query->take($_data['limit']);
            })
            ->orderBy(self::TABLE.'.created_at', 'DESC');
        return isset($_data['perPage']) ? $notifies->paginate($_data['perPage']) : $notifies->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function delete($_id){
        return DB::table(self::TABLE)->delete($_id);
    }
}