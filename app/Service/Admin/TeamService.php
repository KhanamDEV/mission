<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 14/05/2021
 * Time: 9:36 AM
 **/


namespace App\Service\Admin;


use App\Repository\Admin\Mission\MissionRepositoryInterface;
use App\Repository\Admin\Team\TeamRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TeamService
{
    private $teamRepository;
    private $missionRepository;

    public function __construct(TeamRepositoryInterface $teamRepository, MissionRepositoryInterface $missionRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->missionRepository = $missionRepository;
    }

    public function getList($perPage = 10){
        return $this->teamRepository->getList($perPage);
    }

    public function getAll(){
        return $this->teamRepository->getAll(Auth::guard('admin')->user()->id);
    }

    public function findById($id){
        return $this->teamRepository->findById($id);
    }

    public function getListByUserId($id){
        $teams = $this->teamRepository->getListByUserId($id);
        foreach ($teams as $team){
            $timeEndTeam = strtotime(date('Y/m/d H:i:s', strtotime('+1 month', strtotime($team->program_started_at))));
            $team->old = (strtotime(date('Y/m/d H:i:s')) > $timeEndTeam ) ? 1: 0;
        }
        return $teams;
    }


    public function getProgramByTeamId($teamId){
        return $this->teamRepository->getProgramByTeamId($teamId);
    }
}