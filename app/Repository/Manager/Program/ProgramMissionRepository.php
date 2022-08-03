<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 2:49 PM
 **/


namespace App\Repository\Manager\Program;


use Illuminate\Support\Facades\DB;

class ProgramMissionRepository implements ProgramMissionRepositoryInterface
{

    const TABLE = 'program_missions';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getListByProgramId($_program_id)
    {
        return DB::table(self::TABLE)
            ->select('mission_bases.name', self::TABLE.'.delivery_date_number', self::TABLE.'.id', self::TABLE.'.mission_id')
            ->rightJoin('mission_bases', self::TABLE.'.mission_id', '=', 'mission_bases.id')
            ->where(self::TABLE.'.program_id', $_program_id)
            ->get();
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->delete($_id);
    }


    public function checkHas($_data)
    {
        return DB::table(self::TABLE)
            ->where('program_id', $_data['program_id'])
            ->where('mission_id', $_data['mission_id'])
            ->count();
    }

    public function deleteByProgram($_data)
    {
        if (!count(DB::table(self::TABLE)
            ->where('program_id',$_data['program_id'])
            ->when(isset($_data['mission_base_id']), function ($query) use ($_data){
                return $query->where('mission_id', $_data['mission_base_id']);
            })->get())) return  true;
        return DB::table(self::TABLE)
            ->where('program_id',$_data['program_id'])
            ->when(isset($_data['mission_base_id']), function ($query) use ($_data){
                return $query->where('mission_id', $_data['mission_base_id']);
            })
            ->delete();
    }
}