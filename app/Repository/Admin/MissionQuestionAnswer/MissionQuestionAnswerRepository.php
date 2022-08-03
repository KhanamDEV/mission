<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 09/06/2021
 * Time: 13:10
 */

namespace App\Repository\Admin\MissionQuestionAnswer;


use Illuminate\Support\Facades\DB;

class MissionQuestionAnswerRepository implements MissionQuestionAnswerRepositoryInterface
{

    const TABLE = 'mission_question_answers';

    public function getListByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)
            ->where('mission_id', '=', $_mission_id)
            ->get();
    }

    public function getListByUserId($_user_id, $_mission_id){
        return DB::table(self::TABLE)
            ->where('user_id', '=', $_user_id)
            ->where('mission_id', '=', $_mission_id)
            ->get();
    }

    public function getListMissionByUserId($_user_id)
    {
        return DB::table(self::TABLE)
            ->select('missions.*', 'teams.name as team_name', 'mission_bases.is_target')
            ->rightJoin('missions', self::TABLE.'.mission_id', '=', 'missions.id')
            ->rightJoin('teams', 'missions.team_id', '=', 'teams.id')
            ->rightJoin('mission_bases', 'missions.mission_base_id', '=', 'mission_bases.id')
            ->where(self::TABLE.'.user_id', '=', $_user_id)
            ->groupBy(self::TABLE.'.mission_id')
            ->orderByDesc('id')
            ->get();
    }

    public function getListAnsweredByUserAndTeam($_data)
    {
        return DB::table(self::TABLE)
            ->select(DB::raw('count(mission_id) as number'))
            ->where('team_id', '=', $_data['team_id'])
            ->where('user_id' , '=', $_data['user_id'])
            ->whereIn('mission_id', $_data['mission_id'])
            ->groupBy('user_id')
            ->get();
    }

    public function deleteByMissionId($_mission_id)
    {
        if (!DB::table(self::TABLE)->where('mission_id', $_mission_id)->count()) return true;
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete();
    }
}