<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 04/10/2021
 * Time: 21:26
 */

namespace App\Repository\User\MissionQuestionAnswer;

use Illuminate\Support\Facades\DB;

class MissionQuestionAnswerBaseRepository implements MissionQuestionAnswerBaseRepositoryInterface
{

    const TABLE = 'mission_question_answer_bases';

    public function getByMissionBaseId($_mission_base_id)
    {
        return DB::table(self::TABLE)->where('mission_base_id', $_mission_base_id)->orderBy('delivery_order_number', 'ASC')->get();
    }
}