<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 13:55
 */

namespace App\Repository\Api\Mission;


interface MissionQuestionAnswerRepositoryInterface
{
    public function getListMissionByUserId($_data);

    public function store($_data);

    public function getByMissionId($_mission_id, $_user_id);

    public function deleteByMissionId($_mission_id);

    public function countUserAnswerQuestion($_data);

    public function getAllByMissionId($_mission_id);
}