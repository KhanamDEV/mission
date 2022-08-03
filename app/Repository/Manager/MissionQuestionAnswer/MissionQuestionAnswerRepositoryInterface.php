<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 16/06/2021
 * Time: 11:17
 */

namespace App\Repository\Manager\MissionQuestionAnswer;


interface MissionQuestionAnswerRepositoryInterface
{
    public function getListByMissionId($_mission_id);

    public function getListByUserId($_user_id, $_mission_id);

    public function getListMissionByUserId($_user_id);

    public function deleteByMissionId($_mission_id);

    public function getListAnsweredByUserAndTeam($_data);

    public function getListDownload($_id);
}