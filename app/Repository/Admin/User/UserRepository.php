<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 11:22 AM
 **/


namespace App\Repository\Admin\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    const TABLE = 'users';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function deleteByBrandId()
    {
        return DB::table(self::TABLE)->where('brand_id', Auth::guard('admin')->user()->id)->delete();
    }

    public function getList($_per_page)
    {
        return DB::table(self::TABLE)
            ->where('brand_id', Auth::guard('admin')->user()->id)
            ->paginate($_per_page);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->where('id', $_id)
            ->where('brand_id', Auth::guard('admin')->user()->id)
            ->first();
    }

    public function updateByEmail($_email, $_data)
    {
        return DB::table(self::TABLE)->where('email', $_email)->update($_data);
    }

    public function checkHasUserByEmail($_email)
    {
        return DB::table(self::TABLE)->where('email', '=', $_email)->count();
    }

    public function findByEmail($_email){
        return DB::table(self::TABLE)->where('email', '=', $_email)->first();
    }

    public function getAll($_brand_id)
    {
        return DB::table(self::TABLE)
            ->where('brand_id', $_brand_id)
            ->get();
    }

    public function upNumberNotification($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update(['number_notification' => DB::raw('number_notification + 1'), 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->delete($_id);
    }
}