<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 11:54 AM
 **/


namespace App\Repository\Admin\Brand;


use Illuminate\Support\Facades\DB;

class BrandRepository implements BrandRepositoryInterface
{

    const TABLE = 'brands';

    public function create($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
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

    public function updateByEmail($_email, $_data)
    {
        return DB::table(self::TABLE)->where('email', $_email)->update($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }
}