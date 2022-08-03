<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 10:33
 */

namespace App\Repository\Admin\Feedback;

use Illuminate\Support\Facades\DB;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    const TABLE = 'feedbacks';

    public function deleteByUserId($_user_id)
    {
        return DB::table(self::TABLE)->where('user_id', $_user_id)->delete();
    }

    public function deleteByMissionId($_mission_id)
    {
        return DB::table(self::TABLE)->where('mission_id', $_mission_id)->count() ?
            DB::table(self::TABLE)->where('mission_id', $_mission_id)->delete() : true;
    }
}