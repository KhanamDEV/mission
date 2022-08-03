<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 2:57 PM
 **/


namespace App\Service\Manager;


use App\Repository\Manager\Mission\MissionRepositoryInterface;
use App\Repository\Manager\Team\TeamRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;

class TeamService
{
    private $teamRepository;
    private $teamMemberRepository;
    private $missionRepository;

    public function __construct(TeamRepositoryInterface $teamRepository, TeamMemberRepositoryInterface $teamMemberRepository, MissionRepositoryInterface $missionRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->missionRepository = $missionRepository;
    }

    public function getList(){
        $data = [
            'brand_id' => request()->route('brand_id'),
            'perPage' => 10
        ];
        return $this->teamRepository->getList($data);
    }

    public function getAll($data){
        return $this->teamRepository->getList(['brand_id' => $data['brand_id']]);
    }

    public function findById($id){
        $dataFindUser = [
            'brand_id' => request()->route('brand_id'),
            'team_id' => $id
        ];
        return [
            'info' => $this->teamRepository->findById($id),
            'users' => $this->teamMemberRepository->getList($dataFindUser)
        ];
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