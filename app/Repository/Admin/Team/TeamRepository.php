<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:28 AM
 **/


namespace App\Repository\Admin\Team;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamRepository implements TeamRepositoryInterface
{

    const TABLE = 'teams';

    public function getList($_per_page)
    {
        return DB::table(self::TABLE)->where('brand_id', '=', Auth::guard('admin')->user()->id)->orderByDesc('id')->paginate($_per_page);
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
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

    public function getAll($_brand_id){
        return DB::table(self::TABLE)->where('brand_id', $_brand_id)->get();
    }
}