<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 04/10/2021
 * Time: 21:25
 */

namespace App\Repository\User\MissionQuestionAnswer;

interface MissionQuestionAnswerBaseRepositoryInterface
{
    public function getByMissionBaseId($_mission_base_id);
}