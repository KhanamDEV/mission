<?php


namespace App\Repository\Api\ProgramMission;


use Illuminate\Support\Facades\DB;

class ProgramMissionRepository implements ProgramMissionRepositoryInterface
{
    const TABLE = 'program_missions';


    public function getListByProgramId($_program_id)
    {
        return DB::table(self::TABLE)->where('program_id', '=', $_program_id)->get();
    }

    public function findByData($_data)
    {
        return DB::table(self::TABLE)
            ->when(isset($_data['mission_id']), function ($query) use ($_data){
                return $query->where('mission_id', '=', $_data['mission_id']);
            })
            ->when(isset($_data['program_id']), function ($query) use ($_data){
                return $query->where('program_id', '=', $_data['program_id']);
            })->first();
    }
}

