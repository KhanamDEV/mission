<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 04/10/2021
 * Time: 21:12
 */

namespace App\Repository\Admin\ProgramMission;

interface ProgramMissionRepositoryInterface
{
    public function getListByProgramId($_program_id);
}