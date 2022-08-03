<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 13/05/2021
 * Time: 2:37 PM
 **/


namespace App\Service\Admin;


use App\Repository\Admin\Mission\MissionRepositoryInterface;

class MissionService
{
    private $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function getListByUserId($userId){
        return $this->missionRepository->getListByUserId($userId);
    }

    public function show($id){
        return $this->missionRepository->show($id);
    }

    public function getListByTeamId($teamId){
        return $this->getListByTeamId($teamId);
    }

}