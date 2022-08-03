<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 18/06/2021
 * Time: 11:43
 */

namespace App\Repository\Manager\Feedback;


interface FeedbackRepositoryInterface
{
    public function store($_data);

    public function getListDownload($_data);

    public function deleteByMissionId($_mission_id);

    public function findByMissionId($_mission_id);

    public function deleteByUserId($_user_id);
}