<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 13:36
 */

namespace App\Repository\User\TeamMember;


use Illuminate\Support\Facades\DB;

class TeamMemberRepository implements TeamMemberRepositoryInterface
{

    const TABLE = 'team_members';

    public function getListByTeamId($_team_id)
    {
        return DB::table(self::TABLE)
            ->select('users.*')
            ->rightJoin('users', self::TABLE.'.user_id', '=', 'users.id')
            // ->orderByDesc('id')
            ->where(self::TABLE.'.team_id', $_team_id)->get();
    }

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->count() ?
            DB::table(self::TABLE)->where('user_id', $_user_id)->delete() : true;
    }
}