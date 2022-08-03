<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 09:42
 */

namespace App\Repository\Manager\Question;

interface MissionQuestionRepositoryInterface
{
    public function deleteByMissionId($_mission_id);
}