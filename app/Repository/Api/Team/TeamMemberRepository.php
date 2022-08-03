<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 09:47
 */

namespace App\Repository\Api\Team;


use Illuminate\Support\Facades\DB;

class TeamMemberRepository implements TeamMemberRepositoryInterface
{

    const TABLE = 'team_members';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getListMemberByTeamId($_team_id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.is_leader', self::TABLE . '.id', 'users.name_sei', 'users.name_mei', 'users.name_sei_kana', 'users.name_mei_kana', 'users.thumbnail_url', self::TABLE.'.user_id', 'users.push_notification_token')
            ->rightJoin('users', self::TABLE . '.user_id', '=', 'users.id')
            ->where(self::TABLE . '.team_id', '=', $_team_id)
            ->orderByDesc('is_leader')
            ->orderByDesc('user_id')
            ->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->select( self::TABLE . '.user_id', 'users.name_sei', 'users.name_mei', 'users.thumbnail_url', 'users.detail', 'users.birthday', 'users.name_sei_kana', 'users.name_mei_kana', 'users.department')
            ->rightJoin('users', self::TABLE . '.user_id', '=', 'users.id')
            ->where(self::TABLE.'.id', '=', $_id)
            ->first();
    }

    public function deleteByTeamId($_team_id)
    {
        if (!DB::table(self::TABLE)->where('team_id', $_team_id)->count()) return true;
        return DB::table(self::TABLE)->where('team_id', '=', $_team_id)->delete();
    }

    public function getListByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->get();
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function deleteByUserIdAndTeamId($_user_id, $_team_id)
    {
        if (!DB::table(self::TABLE)->where('team_id', $_team_id)->where('user_id', $_user_id)->count()) return true;
        return DB::table(self::TABLE)->where('team_id', '=', $_team_id)->where('user_id', $_user_id)->delete();
    }
}