<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 10/06/2021
 * Time: 10:21
 */

namespace App\Repository\User\ProgramHistory;


interface ProgramHistoryRepositoryInterface
{
    public function getListByTeamId($_team_id);

}