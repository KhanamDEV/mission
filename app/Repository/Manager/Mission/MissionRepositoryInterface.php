<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 9:43 AM
 **/


namespace App\Repository\Manager\Mission;


interface MissionRepositoryInterface
{
    public function findById($_id);

    public function getListByUserId($_user_id);

    public function getListByTeamId($_team_id);

    public function getListByProgramMission($_data);

    public function delete($_id);

    public function store($_data);

    public function getListByUserAndTeamId($_data);

    public function getListDownload($_data);

    public function deleteByUserId($_user_id);

    public function getListByTarget($_user_id);
}