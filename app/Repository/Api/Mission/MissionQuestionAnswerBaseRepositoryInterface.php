<?php
/**
 * Created by PhpStorm.
 * User: phanthanhcuong
 * Date: 25/05/2021
 * Time: 14:21
 */

namespace App\Repository\Api\Mission;


interface MissionQuestionAnswerBaseRepositoryInterface
{
    public function getByMissionBaseId($_mission_base_id);

    public function findById($_id);
}