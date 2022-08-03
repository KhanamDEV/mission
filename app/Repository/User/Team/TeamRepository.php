<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 10:39
 */

namespace App\Repository\User\Team;


use Illuminate\Support\Facades\DB;

class TeamRepository implements TeamRepositoryInterface
{

    const TABLE = 'teams';

    public function getListByBrandId($_brand_id, $_per_page)
    {
        return DB::table(self::TABLE)
            ->where('brand_id', '=', $_brand_id)
            ->orderByDesc('id')
            ->paginate($_per_page);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->where('id', '=', $_id)
            ->first();
    }

    public function getListByUserId($_user_id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.*')
            ->leftJoin('team_members', self::TABLE.'.id', '=', 'team_members.team_id')
            ->where('team_members.user_id', '=', $_user_id)
            ->orderByDesc('id')
            ->get();
    }

    public function getProgramByTeamId($_team_id)
    {
        return DB::table(self::TABLE)
            ->select('programs.*')
            ->rightJoin('programs', self::TABLE . '.program_id', '=', 'programs.id')
            ->where(self::TABLE.'.id', $_team_id)
            ->first();
    }
}