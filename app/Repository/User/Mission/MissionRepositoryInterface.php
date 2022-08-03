<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 10:02
 */

namespace App\Repository\User\Mission;


interface MissionRepositoryInterface
{
    public function getListByUserId($_user_id);

    public function findById($_id);

    public function getListByTeamId($_team_id);

    public function getListByUserAndTeamId($_data);

    public function getMissionTarget($_user_id);

    public function delete($_id);
}