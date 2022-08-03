<?php


namespace App\Repository\Api\Feedback;


use Illuminate\Support\Facades\DB;

class FeedbackBaseRepository implements FeedbackBaseRepositoryInterface
{

    const TABLE = 'feedback_bases';

    public function findByMissionBaseId($_id)
    {
        return DB::table(self::TABLE)->where('mission_base_id', '=', $_id)->first();
    }
}