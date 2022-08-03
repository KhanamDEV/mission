<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 18/06/2021
 * Time: 11:44
 */

namespace App\Repository\Manager\Feedback;


use Illuminate\Support\Facades\DB;

class FeedbackRepository implements FeedbackRepositoryInterface
{

    const TABLE = 'feedbacks';

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function getListDownload($_data)
    {
            return DB::table(self::TABLE)
                ->select('users.name_sei', 'users.name_mei', 'users.name_sei_kana', 'users.name_mei_kana', 'missions.name as mission_name', self::TABLE.'.*')
                ->leftJoin('missions', self::TABLE.'.mission_id', '=', 'missions.id')
                ->leftJoin('users', self::TABLE.'.user_id', '=', 'users.id')
                ->whereDate(self::TABLE.'.created_at', '>=', $_data['start_date'])
                ->whereDate(self::TABLE.'.created_at', '<=', $_data['end_date'])
                ->whereIn(self::TABLE.'.user_id', $_data['team_member'])
                ->get();
    }

    public function deleteByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->count() ?
            DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete() : true;
    }

    public function findByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->first();
    }

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->delete();
    }
}