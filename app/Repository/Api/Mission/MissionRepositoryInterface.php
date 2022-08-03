<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 22/06/2021
 * Time: 10:24
 */

namespace App\Repository\Api\Mission;


interface MissionRepositoryInterface
{
    public function getListNotAnswerByUserId($_data);

    public function getListNotAnswerByUserTargetId($_data);

    public function getListQuestion($_data);

    public function findById($_id);

    public function store($_data);

    public function update($_id, $_data);

    public function delete($_id);

    public function getListByTeam($_data);

    public function getList();

    public function getMissionSame($_data);

    public function getListByUserAndTeamId($_arr_user, $team_id);

    public function findMissionTarget($_data);
}