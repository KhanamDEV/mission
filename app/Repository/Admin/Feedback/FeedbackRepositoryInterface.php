<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 10:02
 */

namespace App\Repository\Admin\Feedback;

interface FeedbackRepositoryInterface
{
    public function deleteByUserId($_user_id);

    public function deleteByMissionId($_mission_id);
}