<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 09:42
 */

namespace App\Repository\Manager\Question;

use Illuminate\Support\Facades\DB;

class MissionQuestionRepository implements MissionQuestionRepositoryInterface
{

    const TABLE = 'mission_questions';

    public function deleteByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->count() ?
            DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete() : true;
    }
}