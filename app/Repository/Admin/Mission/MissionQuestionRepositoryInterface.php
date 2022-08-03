<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 18/01/2022
 * Time: 10:40
 */

namespace App\Repository\Admin\Mission;

interface MissionQuestionRepositoryInterface
{
    public function deleteByMissionId($_mission_id);
}