<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 10:14
 */

namespace App\Service\User\Mission;


use App\Repository\User\Mission\MissionRepositoryInterface;

class MissionService
{
    private $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function getListByUserId($id){
        return $this->missionRepository->getListByUserId($id);
    }

    public function findById($id){
        return $this->missionRepository->findById($id);
    }
}