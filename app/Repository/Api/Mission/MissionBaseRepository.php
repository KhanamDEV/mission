<?php
/**
 * Created by PhpStorm.
 * User: phanthanhcuong
 * Date: 25/05/2021
 * Time: 14:21
 */

namespace App\Repository\Api\Mission;


use Illuminate\Support\Facades\DB;

class MissionBaseRepository implements MissionBaseRepositoryInterface
{
    const TABLE = 'mission_bases';

    public function getListMission($_data)
    {
        return DB::table(self::TABLE)
            ->when(($_data['type'] == 'answered'), function ($query) use ($_data){
               return $query->whereIn('id', $_data['mission_answered']);
            })
            ->when(($_data['type'] == 'not_answered'), function ($query) use ($_data){
                return $query->whereNotIn('id', $_data['mission_answered']);
            })
            ->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', '=', $_id)->first();
    }
}