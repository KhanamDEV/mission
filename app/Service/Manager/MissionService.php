<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 9:42 AM
 **/


namespace App\Service\Manager;


use App\Repository\Manager\Mission\MissionRepositoryInterface;

class MissionService
{
    private $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository )
    {
        $this->missionRepository = $missionRepository;
    }

    public function findById($id){
        return $this->missionRepository->findById($id);
    }

    public function getListByUserId($userId){
        return $this->missionRepository->getListByUserId($userId);
    }


}