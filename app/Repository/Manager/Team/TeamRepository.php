<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 2:48 PM
 **/


namespace App\Repository\Manager\Team;


use Illuminate\Support\Facades\DB;

class TeamRepository implements TeamRepositoryInterface
{

    const TABLE = 'teams';

    public function getList($_data)
    {
        $data = DB::table(self::TABLE)
            ->where('brand_id', $_data['brand_id'])
            ->where('is_active', 1)
            ->orderBy('id', 'DESC');
        return isset($_data['perPage']) ? $data->paginate($_data['perPage']) : $data->get();

    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->where('id', $_id)
            ->first();
    }

    public function getListByUserId($_id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.*')
            ->leftJoin('team_members', self::TABLE.'.id', '=', 'team_members.team_id')
            ->where('team_members.user_id', '=', $_id)
            ->orderByDesc('id')
            ->get();
    }

    public function getProgramByTeamId($_team_id)
    {
        return DB::table(self::TABLE)
            ->select('programs.*')
            ->rightJoin('programs', self::TABLE.'.program_id', '=', 'programs.id')
            ->where(self::TABLE.'.id', '=', $_team_id)
            ->first();
    }

    public function getListByProgramId($_program_id)
    {
        return DB::table(self::TABLE)
            ->where('program_id', $_program_id)
            ->get();
    }
}