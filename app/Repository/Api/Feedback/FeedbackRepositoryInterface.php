<?php


namespace App\Repository\Api\Feedback;


interface FeedbackRepositoryInterface
{
    public function getList($_data);

    public function findById($_id);

    public function updateByMission($_data, $_id);

    public function store($_data);

    public function update($_id, $_data);

    public function delete($_id);

    public function getByMission($_mission_id);

    public function getEligibleShow();

    public function deleteByMissionId($_mission_id);

    public function updateByUserTarget($_data);

    public function findByMissionIdAndUserId($_data);

}