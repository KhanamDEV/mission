<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 11:14
 */

namespace App\Repository\User\Feedback;

use Illuminate\Support\Facades\DB;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    const TABLE = 'feedbacks';

    public function deleteByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->count() ?
            DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete() : true;
    }
}