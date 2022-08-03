<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 10/06/2021
 * Time: 10:21
 */

namespace App\Repository\User\ProgramHistory;


use Illuminate\Support\Facades\DB;

class ProgramHistoryRepository implements ProgramHistoryRepositoryInterface
{
    const TABLE = 'program_histories';

    public function getListByTeamId($_team_id){
        return DB::table(self::TABLE)
            ->select('programs.*', self::TABLE.'.id as program_history_id')
            ->rightJoin('programs', self::TABLE.'.program_id', '=', 'programs.id')
            ->where(self::TABLE.'.team_id', '=', $_team_id)
            ->orderBy('program_history_id', 'DESC')
            ->get();
    }
}