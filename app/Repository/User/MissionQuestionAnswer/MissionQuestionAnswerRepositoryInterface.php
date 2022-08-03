<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 10/06/2021
 * Time: 10:00
 */

namespace App\Repository\User\MissionQuestionAnswer;


interface MissionQuestionAnswerRepositoryInterface
{
    public function getListByMissionId($_mission_id);

    public function getListByUserId($_user_id, $_mission_id);

    public function getListMissionByUserId($_user_id);

    public function getListAnsweredByUserAndTeam($_data);

    public function deleteByMissionId($_mission_id);

}