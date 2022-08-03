<?php


namespace App\Repository\Api\Feedback;


use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    const TABLE = 'feedbacks';

    public function getList($_data)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.*', 'missions.target_user_id', 'mission_bases.is_target', 'missions.delivery_order_date')
            ->leftJoin('missions', self::TABLE . '.mission_id', '=', 'missions.id')
            ->leftJoin('mission_bases', 'missions.mission_base_id', '=', 'mission_bases.id')
            ->where(self::TABLE . '.user_id', $_data['id'])
            ->when(isset($_data['team_id']), function ($query) use ($_data) {
                return $query->where('missions.team_id', $_data['team_id']);
            })
            ->whereDate('missions.delivery_order_date', '<=', date('Y-m-d'))
            ->orderByDesc('missions.delivery_order_date')
            ->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.*', 'missions.mission_base_id')
            ->leftJoin('missions', self::TABLE . '.mission_id', '=', 'missions.id')
            ->where(self::TABLE . '.id', '=', $_id)
            ->first();
    }

    public function updateByMission($_data, $_mission_id)
    {
            return DB::table(self::TABLE)->where('mission_id', '=', $_mission_id)->update($_data);
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function update($_id, $_data)
    {
        return DB::table(self::TABLE)->where('id', '=', $_id)->update($_data);
    }

    public function delete($_id)
    {
        return DB::table(self::TABLE)->delete($_id);
    }

    public function getByMission($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->first();
    }

    public function getEligibleShow(){
        return DB::table(self::TABLE)
            ->select(self::TABLE.'.*', 'missions.team_id')
            ->leftJoin('missions', self::TABLE.'.mission_id', '=', 'missions.id')
            ->where(self::TABLE.'.percent', '>', 0.5)
            ->get();
    }

    public function deleteByMissionId($_mission_id)
    {
        if (!DB::table(self::TABLE)->where('mission_id', $_mission_id)->count()) return true;
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete();
    }

    public function updateByUserTarget($_data){
        return DB::table(self::TABLE)
            ->where('mission_id', $_data['mission_id'])
            ->where('user_id', $_data['user_id'])
            ->update(['percent' => 1, 'public_time' => date('Y-m-d H:i:s') , 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function findByMissionIdAndUserId($_data)
    {
        return DB::table(self::TABLE)
            ->where('mission_id', $_data['mission_id'])
            ->where('user_id', $_data['user_id'])
            ->first();
    }


}