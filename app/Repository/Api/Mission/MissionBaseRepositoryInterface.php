<?php
/**
 * Created by PhpStorm.
 * User: phanthanhcuong
 * Date: 25/05/2021
 * Time: 14:21
 */

namespace App\Repository\Api\Mission;


interface MissionBaseRepositoryInterface
{
    public function getListMission($_data);

    public function findById($_id);
}