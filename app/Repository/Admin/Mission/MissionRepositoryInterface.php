<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 2:34 PM
 **/


namespace App\Repository\Admin\Mission;


interface MissionRepositoryInterface
{
    public function getListByUserId($_user_id);

    public function show($_id);

    public function getListByTeamId($_team_id);

    public function getListByUserAndTeamId($_data);

    public function delete($_id);
}