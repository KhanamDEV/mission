<?php

namespace App\Repository\Manager\Mission;


use Illuminate\Support\Facades\DB;
use App\Repository\Manager\Mission\MissionBaseRepositoryInterface;
use App\Model\MissionBase;
use mysql_xdevapi\Exception;

class MissionBaseRepository implements MissionBaseRepositoryInterface
{

    const TABLE = 'mission_bases';

    public function getList($_per_page)
    {
        return DB::table(self::TABLE)->orderBy('id', 'DESC')->paginate($_per_page);
    }

    public function findById($id)
    {
        return MissionBase::with(['feedback_base', 'question_bases'])->where('id', $id)->first();
    }

    public function store($data)
    {
        return DB::table(self::TABLE)->insertGetId($data);
    }

    public function update($id, $data)
    {
        return DB::table(self::TABLE)->where('id', $id)->update($data);
    }


    public function destroy($id)
    {
        return DB::table(self::TABLE)->where('id', $id)->delete();
    }

    public function checkUsed($id){
            return DB::table(self::TABLE)
                ->select('program_missions.*')
                ->rightJoin('program_missions', self::TABLE.'.id', '=', 'program_missions.mission_id')
                ->where('program_missions.mission_id', '=', $id)
                ->count();
    }
}