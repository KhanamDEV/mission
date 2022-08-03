<?php

namespace App\Repository\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    const TABLE = 'users';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function updateByEmail($_email, $_data)
    {
        return DB::table(self::TABLE)->where('email', $_email)->update($_data);
    }

    public function activeByVerificationCode($_verification_code)
    {
        return DB::table(self::TABLE)
            ->where('verification_code', $_verification_code)
            ->update(['verified' => 1, 'email_verified_at' => date('Y/m/d H:i:s')]);
    }

    public function checkHasVerificationCode($_verification_code)
    {
        return DB::table(self::TABLE)
            ->where('verification_code', $_verification_code)
            ->where('verified', '=', 0)
            ->count();
    }

    public function deleteByVerificationCode($_verification_code)
    {
        return DB::table(self::TABLE)
            ->where('verification_code', $_verification_code)
            ->delete();
    }

    public function checkHasAccount($_email)
    {
        return DB::table(self::TABLE)
            ->where('email', $_email)
            ->count();
    }

    public function truncate()
    {
        DB::table(self::TABLE)->truncate();
    }

    public function getListByBrandId($_brand_id, $_per_page)
    {
        return DB::table(self::TABLE)
            ->where('brand_id', '=', $_brand_id)
            ->paginate($_per_page);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->where('id', $_id)
            ->where('brand_id', Auth::guard('user')->user()->brand_id)
            ->first();
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function checkHasUserByEmail($_email)
    {
        return DB::table(self::TABLE)->where('email', '=', $_email)->count();
    }

    public function findByEmail($_email)
    {
        return DB::table(self::TABLE)->where('email', $_email)->first();

    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}