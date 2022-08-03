<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 11:13
 */

namespace App\Repository\User\Feedback;

interface FeedbackRepositoryInterface
{
    public function deleteByMissionId($_mission_id);
}