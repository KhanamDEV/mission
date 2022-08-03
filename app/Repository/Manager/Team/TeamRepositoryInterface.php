<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 2:48 PM
 **/


namespace App\Repository\Manager\Team;


interface TeamRepositoryInterface
{
    public function getList($_data);

    public function findById($_id);

    public function getListByUserId($_id);

    public function getProgramByTeamId($_team_id);

    public function getListByProgramId($_program_id);
}