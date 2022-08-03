<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 3:27 PM
 **/


namespace App\Repository\Manager\TeamMember;


use Illuminate\Support\Facades\DB;

class TeamMemberRepository implements TeamMemberRepositoryInterface
{

    const TABLE = 'team_members';

    public function getList($_data)
    {
        return DB::table(self::TABLE)
            ->select('users.*')
            ->rightJoin('users', self::TABLE.'.user_id', '=', 'users.id')
            ->where(self::TABLE.'.team_id', $_data['team_id'])
            ->where(self::TABLE.'.brand_id', $_data['brand_id'])
            ->where(self::TABLE.'.is_active', 1)
            ->get();
    }

    public function getUserDownload($_data)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.team_id', 'teams.name', 'brands.name as brand_name','users.*')
            ->rightJoin('users', self::TABLE.'.user_id', '=', 'users.id')
            ->leftJoin('teams', self::TABLE.'.team_id', '=', 'teams.id')
            ->leftJoin('brands', self::TABLE.'.brand_id', '=', 'brands.id')
            ->where(self::TABLE.'.team_id', $_data['team_id'])
            ->where(self::TABLE.'.brand_id', $_data['brand_id'])
            ->where(self::TABLE.'.is_active', 1)
            ->get();
    }

    public function getListByUser($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->get();
    }

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->count() ?
            DB::table(self::TABLE)->where('user_id', $_user_id)->delete() : true;
    }
}