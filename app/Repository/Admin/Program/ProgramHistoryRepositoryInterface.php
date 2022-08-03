<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 08/06/2021
 * Time: 10:15
 */

namespace App\Repository\Admin\Program;


interface ProgramHistoryRepositoryInterface
{
    public function getListByTeamId($_team_id);
}