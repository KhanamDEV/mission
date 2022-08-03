<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 2:35 PM
 **/


namespace App\Repository\Admin\Mission;


use Illuminate\Support\Facades\DB;

class MissionRepository implements MissionRepositoryInterface
{

    const TABLE = 'missions';

    public function getListByUserId($_user_id)
    {
        return DB::table(self::TABLE)
            ->where('user_id', $_user_id)
            ->orWhere('target_user_id', $_user_id)
            ->get();
    }

    public function show($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function getListByTeamId($_team_id){
        return DB::table(self::TABLE)
            ->where('team_id', '=', $_team_id)->get();
    }

    public function getListByUserAndTeamId($_data){
        return DB::table(self::TABLE)
            ->where('team_id', '=', $_data['team_id'])
            ->where('user_id', '=', $_data['user_id'])
            ->orWhere('target_user_id', '=', $_data['user_id'])
            ->get();
    }

    public function deleteByUserId($_user_id){
        return DB::table(self::TABLE)->where('user_id', $_user_id)->delete();
    }

    public function getListByTarget($_user_id)
    {
        return DB::table(self::TABLE)
            ->where(self::TABLE.'.target_user_id', $_user_id)
            ->get();
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }
}