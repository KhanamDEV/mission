<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 10:24
 */

namespace App\Repository\Api\Mission;


use Illuminate\Support\Facades\DB;

class MissionRepository implements MissionRepositoryInterface
{

    const TABLE = 'missions';

    public function getListNotAnswerByUserId($_data)
    {
        $missionAnswered =  DB::table('mission_question_answers')
            ->where('user_id', '=', $_data['user_id'])
            ->groupBy('mission_id')
            ->pluck('mission_id');
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.*', 'teams.name as team_name', 'mission_bases.is_target')
            ->leftJoin('teams', self::TABLE.'.team_id', '=', 'teams.id')
            ->leftJoin('mission_bases', self::TABLE.'.mission_base_id', '=', 'mission_bases.id')
            ->whereNotIn(self::TABLE.'.id', $missionAnswered)
            ->whereDate(self::TABLE.'.delivery_order_date', '<=', date('Y-m-d'))
            ->where(self::TABLE.'.user_id', '=', $_data['user_id'])
            ->when(isset($_data['team_id']), function ($query) use ($_data) {
                return $query->where(self::TABLE.'.team_id', '=', $_data['team_id']);
            })
            ->orderBy(self::TABLE.'.created_at', 'DESC')
            ->get();
    }

    public function getListNotAnswerByUserTargetId($_data){
        $missionAnswered =  DB::table('mission_question_answers')
            ->where('user_id', '=', $_data['user_id'])
            ->groupBy('mission_id')
            ->pluck('mission_id');
            return DB::table(self::TABLE)
                ->select(self::TABLE.'.*', 'teams.name as team_name', 'mission_bases.is_target')
                ->leftJoin('teams', self::TABLE.'.team_id', '=', 'teams.id')
                ->leftJoin('mission_bases', self::TABLE.'.mission_base_id', '=', 'mission_bases.id')
                ->whereNotIn(self::TABLE.'.id', $missionAnswered)
                ->whereDate(self::TABLE.'.delivery_order_date', '<=', date('Y-m-d'))
                ->where(self::TABLE.'.target_user_id', '=', $_data['user_id'])
                ->when(isset($_data['team_id']), function ($query) use ($_data) {
                    return $query->where(self::TABLE.'.team_id', '=', $_data['team_id']);
                })
                ->orderBy(self::TABLE.'.created_at', 'DESC')
                ->get();
    }

    public function getListQuestion($_data){
        return DB::table(self::TABLE)
            ->select('mission_question_answer_bases.*')
            ->rightJoin('mission_bases', self::TABLE.'.mission_base_id', '=', 'mission_bases.id')
            ->rightJoin('mission_question_answer_bases', 'mission_bases.id', 'mission_question_answer_bases.mission_base_id')
            ->where(self::TABLE.'.id', '=', $_data['mission_id'])
//            ->whereDate('mission_question_answer_bases.created_at', '<', $_data['mission_created_at'])
            ->orderBy('delivery_order_number', 'ASC')
            ->get();
    }

    public function findById($_id){
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insertGetId($_data);
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', '=', $_id)->update($_data);
    }


    public function delete($_id)
    {
        if (!DB::table(self::TABLE)->where('id', $_id)->count()) return true;
        return DB::table(self::TABLE)->delete($_id);
    }

    public function getListByTeam($_data)
    {
        return DB::table(self::TABLE)->where('team_id', $_data['team_id'])->where('program_id', $_data['program_id'])->get();
    }

    public function getList()
    {
        return DB::table(self::TABLE)->get();
    }


    public function getMissionSame($_data)
    {
        return DB::table(self::TABLE)
            ->where('team_id', $_data['team_id'])
            ->where('program_id', $_data['program_id'])
            ->where('mission_base_id', $_data['mission_base_id'])
            ->when(isset($_data['target_user_id']) && !is_null($_data['target_user_id']), function ($query) use ($_data){
                return $query->where('target_user_id', $_data['target_user_id']);
            })
            ->get();
    }

    public function getListByUserAndTeamId($_arr_user, $team_id){
        return DB::table(self::TABLE)->where('team_id', $team_id)
            ->whereIn('user_id', $_arr_user)
            ->get();
    }

    public function findMissionTarget($_data){
        return DB::table(self::TABLE)
            ->where('team_id', $_data['team_id'])
            ->where('program_id', $_data['program_id'])
            ->where('target_user_id', $_data['user_id'])
            ->first();
    }
}