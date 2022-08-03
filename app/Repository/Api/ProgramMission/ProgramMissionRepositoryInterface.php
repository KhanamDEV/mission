<?php


namespace App\Repository\Api\ProgramMission;


interface ProgramMissionRepositoryInterface
{
    public function getListByProgramId($_program_id);

    public function findByData($_data);
}