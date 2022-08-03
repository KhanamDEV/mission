<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 16/06/2021
 * Time: 13:46
 */

namespace App\Repository\Manager\Program;


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