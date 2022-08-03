<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 28/05/2021
 * Time: 09:16
 */

namespace App\Repository\Api\Team;


use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class TeamRepository implements TeamRepositoryInterface
{
    const TABLE = 'teams';

    public function getListByUser($user)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.id', self::TABLE.'.name', self::TABLE.'.detail', self::TABLE.'.thumbnail_url')
            ->leftJoin('team_members', self::TABLE.'.id', '=', 'team_members.team_id')
            ->where('team_members.user_id', '=', $user->id)
            ->where(self::TABLE.'.brand_id', JWTAuth::user()->brand_id)
            ->orderBy(self::TABLE.'.created_at', 'DESC')
            ->get();
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insertGetId($_data);
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', $_id)->update($_data);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.*', 'programs.id as program_id', 'programs.name as program_name', 'programs.detail as program_detail')
            ->leftJoin('programs', self::TABLE.'.program_id', '=', 'programs.id')
            ->where(self::TABLE.'.id', '=', $_id)
            ->first();
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->delete($_id);
    }
}