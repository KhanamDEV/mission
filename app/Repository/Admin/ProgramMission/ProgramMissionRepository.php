<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 04/10/2021
 * Time: 21:12
 */

namespace App\Repository\Admin\ProgramMission;

use Illuminate\Support\Facades\DB;

class ProgramMissionRepository implements ProgramMissionRepositoryInterface
{
    const TABLE = 'program_missions';

    public function getListByProgramId($_program_id)
    {
        return DB::table(self::TABLE)
            ->select('mission_bases.*', self::TABLE.'.delivery_date_number', self::TABLE.'.id', self::TABLE.'.mission_id')
            ->rightJoin('mission_bases', self::TABLE.'.mission_id', '=', 'mission_bases.id')
            ->where(self::TABLE.'.program_id', $_program_id)
            ->get();
    }
}