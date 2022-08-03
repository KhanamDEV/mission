<?php

namespace App\Repository\Admin\BrandNotify;

use Illuminate\Support\Facades\DB;

class BrandNotifyRepository implements BrandNotifyRepositoryInterface
{

    const TABLE = 'brand_notifies';

    public function getList($_data)
    {
        $notifies = DB::table(self::TABLE)->where('brand_id', $_data['brand_id'])->orderBy('created_at', 'DESC');
        return isset($_data['perPage']) ? $notifies->paginate($_data['perPage']) : $notifies->get();
    }

    public function findById($_data){
        return DB::table(self::TABLE)
            ->where('id', $_data['id'])
            ->where('brand_id', $_data['brand_id'])
            ->first();
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->delete($_id);
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function destroy($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}