<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 9:43 AM
 **/


namespace App\Repository\Manager\Mission;


use Illuminate\Support\Facades\DB;
use App\Repository\Manager\Mission\MissionRepositoryInterface;
use App\Model\Mission;
class MissionRepository implements MissionRepositoryInterface
{

    const TABLE = 'missions';

    public function getListByTeam($data)
    {
        $query =  Mission::with(['feedbacks', 'team', 'program', 'questions', 'user', 'targetUser'])
        ->whereDate('created_at', '>=', $data['start_date'])
        ->whereDate('created_at', '<=', $data['end_date']);

        if (isset($data['team_id'])) {
            $query = $query->where('team_id', $data['team_id']);
        }

        return $query->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }

    public function getListByUserId($_user_id)
    {
        return DB::table(self::TABLE)
            ->where(self::TABLE.'.user_id', $_user_id)
            ->get();
    }

    public function getListByTeamId($_team_id){
        return DB::table(self::TABLE)->where('team_id', '=', $_team_id)->get();
    }

    public function getListByProgramMission($_data)
    {
        return DB::table(self::TABLE)
            ->where('program_id', $_data['program_id'])
            ->when(isset($_data['mission_base_id']), function ($query) use ($_data){
                return $query->where('mission_base_id', $_data['mission_base_id']);
            })
            ->get();
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->count() ?
            DB::table(self::TABLE)->delete($_id) : true;
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insertGetId($_data);
    }

    public function getListByUserAndTeamId($_data){
        return DB::table(self::TABLE)
            ->where('team_id', '=', $_data['team_id'])
            ->where('user_id', '=', $_data['user_id'])
            ->get();
    }

    public function getListDownload($_data)
    {
        return DB::table(self::TABLE)
            ->where('team_id', $_data['team_id'])
            ->whereDate(self::TABLE.'.created_at', '>=', $_data['start_date'])
            ->whereDate(self::TABLE.'.created_at', '<=', $_data['end_date'])
            ->whereIn(self::TABLE.'.user_id', $_data['team_member'])
            ->get();
    }

    public function deleteByUserId($_user_id){
        return DB::table(self::TABLE)->where('user_id', $_user_id)->delete();
    }

    public function getListByTarget($_user_id)
    {
        return DB::table(self::TABLE)
            ->where(self::TABLE.'.target_user_id', $_user_id)
            ->get();
    }
}