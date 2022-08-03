<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:28 AM
 **/


namespace App\Repository\Admin\Team;


use Illuminate\Support\Facades\DB;

class TeamMemberRepository implements TeamMemberRepositoryInterface
{

    const TABLE = 'team_members';

    public function getListByTeamId($_team_id)
    {
        return DB::table(self::TABLE)
            ->select('users.*')
            ->rightJoin('users', self::TABLE.'.user_id', '=', 'users.id')
            ->where(self::TABLE.'.team_id', $_team_id)->get();
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