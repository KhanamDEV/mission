<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 16/06/2021
 * Time: 13:46
 */

namespace App\Repository\Manager\Program;


interface ProgramHistoryRepositoryInterface
{
    public function getListByTeamId($_team_id);
}