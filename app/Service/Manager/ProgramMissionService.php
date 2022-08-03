<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 3:14 PM
 **/


namespace App\Service\Manager;


use App\Repository\Manager\Program\ProgramMissionRepositoryInterface;

class ProgramMissionService
{
    private $programMissionRepository;

    public function __construct(ProgramMissionRepositoryInterface $programMissionRepository)
    {
        $this->programMissionRepository = $programMissionRepository;
    }

    public function getListByProgramId($programId)
    {
        return $this->programMissionRepository->getListByProgramId($programId);
    }

    public function delete($id){
        return $this->programMissionRepository->delete($id);
    }
}