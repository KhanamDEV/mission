<?php

namespace App\Repository\Api\MissionQuestion;

interface MissionQuestionRepositoryInterface
{
    public function getListByMissionId($_mission_id);

    public function store($_data);

    public function deleteByMissionId($_mission_id);

    public function findByMissionQuestionBaseId($_data);
}