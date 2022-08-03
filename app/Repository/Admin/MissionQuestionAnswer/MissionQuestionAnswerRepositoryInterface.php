<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 09/06/2021
 * Time: 13:09
 */

namespace App\Repository\Admin\MissionQuestionAnswer;


interface MissionQuestionAnswerRepositoryInterface
{
    public function getListByMissionId($_mission_id);

    public function getListByUserId($_user_id, $_mission_id);

    public function getListMissionByUserId($_user_id);

    public function getListAnsweredByUserAndTeam($_data);

    public function deleteByMissionId($_mission_id);
}