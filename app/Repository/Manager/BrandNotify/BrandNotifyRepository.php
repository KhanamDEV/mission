<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 17/11/2021
 * Time: 09:53
 */

namespace App\Repository\Manager\BrandNotify;

use Illuminate\Support\Facades\DB;

class BrandNotifyRepository implements BrandNotifyRepositoryInterface
{

    const TABLE = 'brand_notifies';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function edit($_data, $_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function getList($_data)
    {
        $data = DB::table(self::TABLE)
            ->when(isset($_data['brand_id']), function ($query) use ($_data){
                return $query->where('brand_id', $_data['brand_id']);
            })
            ->orderBy('created_at', 'DESC');
        return isset($_data['perPage']) ? $data->paginate($_data['perPage']) : $data->get();
    }

    public function destroy($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}