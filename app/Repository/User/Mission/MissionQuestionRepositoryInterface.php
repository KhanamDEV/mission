<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 11:37
 */

namespace App\Repository\User\Mission;

interface MissionQuestionRepositoryInterface
{
    public function deleteByMissionId($_mission_id);
}