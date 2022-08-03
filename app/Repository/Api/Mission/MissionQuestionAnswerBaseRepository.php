<?php
/**
 * Created by PhpStorm.
 * User: phanthanhcuong
 * Date: 25/05/2021
 * Time: 14:22
 */

namespace App\Repository\Api\Mission;


use Illuminate\Support\Facades\DB;

class MissionQuestionAnswerBaseRepository implements MissionQuestionAnswerBaseRepositoryInterface
{

    const TABLE = 'mission_question_answer_bases';

    public function getByMissionBaseId($_mission_base_id)
    {
        return DB::table(self::TABLE)->where('mission_base_id', $_mission_base_id)->get();
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE)->where('id', $_id)->first();
    }
}