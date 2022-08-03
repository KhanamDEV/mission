<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 13:57
 */

namespace App\Repository\Api\Mission;


use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class MissionQuestionAnswerRepository implements MissionQuestionAnswerRepositoryInterface
{
    const TABLE = 'mission_question_answers';

    public function getListMissionByUserId($_data){
        return DB::table(self::TABLE)
            ->select('missions.*', 'teams.name as team_name', 'mission_bases.is_target')
            ->rightJoin('missions', self::TABLE.'.mission_id', '=', 'missions.id')
            ->rightJoin('teams', 'missions.team_id', '=', 'teams.id')
            ->rightJoin('mission_bases', 'missions.mission_base_id', '=', 'mission_bases.id')
            ->where(self::TABLE.'.user_id', '=', $_data['user_id'])
            ->when(isset($_data['team_id']), function ($query) use ($_data) {
                return $query->where('missions.team_id', '=', $_data['team_id']);
            })
            ->groupBy(self::TABLE.'.mission_id')
            ->orderByDesc('created_at')
            ->get();
    }

    public function store($_data){
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getByMissionId($_mission_id, $_user_id = null)
    {
        return DB::table(self::TABLE)
            ->when(is_null($_user_id), function ($query) {
                return $query->where('user_id', '=', JWTAuth::user()->id);
            })
            ->when(!is_null($_user_id), function ($query) use ($_user_id) {
                return $query->where('user_id', '=', $_user_id);
            })
            ->where('mission_id', '=', $_mission_id)
            ->get();
    }

    public function deleteByMissionId($_mission_id)
    {
        if (!DB::table(self::TABLE)->where('mission_id', '=', $_mission_id)->count()) return  true;
        return DB::table(self::TABLE)
            ->where('mission_id', '=', $_mission_id)
            ->delete();
    }

    public function countUserAnswerQuestion($_data)
    {

        return DB::table(self::TABLE)
            ->select(DB::raw('count(user_id) as total'))
            ->where('team_id', '=', $_data['team_id'])
            ->whereIn('mission_id', $_data['mission_id'])
            ->groupBy('user_id')
            ->get();
    }

    public function getAllByMissionId($_mission_id){
        return DB::table(self::TABLE)
            ->whereIn('mission_id', $_mission_id)
            ->get();
    }
}