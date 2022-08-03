<?php


namespace App\Repository\Api\Feedback;


interface FeedbackBaseRepositoryInterface
{
    public function findByMissionBaseId($_id);
}