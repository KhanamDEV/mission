<?php

namespace App\Repository\Api\MissionQuestion;

use Illuminate\Support\Facades\DB;

class MissionQuestionRepository implements MissionQuestionRepositoryInterface
{

    const TABLE = 'mission_questions';

    public function getListByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)
            ->select('mission_question_answer_base_id as id', 'title', 'type', 'choice', 'delivery_order_number', 'created_at', 'updated_at')
            ->where('mission_id', $_mission_id)
            ->orderBy('delivery_order_number', 'ASC')
            ->get();
    }

    public function store($_data)
    {
        return DB::table(self::TABLE)->insert($_data);
    }

    public function deleteByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->count() ?
            DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete() : true;
    }

    public function findByMissionQuestionBaseId($_data)
    {
        return DB::table(self::TABLE)
            ->where('mission_question_answer_base_id', $_data['mission_question_answer_base_id'])
            ->where('mission_id', $_data['mission_id'])
            ->first();
    }
}