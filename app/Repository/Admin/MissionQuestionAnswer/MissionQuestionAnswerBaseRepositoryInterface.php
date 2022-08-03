<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 04/10/2021
 * Time: 21:25
 */

namespace App\Repository\Admin\MissionQuestionAnswer;

interface MissionQuestionAnswerBaseRepositoryInterface
{
    public function getByMissionBaseId($_mission_base_id);
}