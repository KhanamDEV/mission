<?php

namespace App\Service\Admin;


use App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\Admin\Program\ProgramRepositoryInterface;
use App\Repository\Admin\ProgramMission\ProgramMissionRepositoryInterface;

class ProgramService
{
    private $program_repository;
    private $program_mission_repository;
    private $mission_question_answer_base_repository;

    public function __construct(ProgramRepositoryInterface $program_repository, ProgramMissionRepositoryInterface $programMissionRepository,
                                MissionQuestionAnswerBaseRepositoryInterface $missionQuestionAnswerBaseRepository)
    {
        $this->program_repository = $program_repository;
        $this->program_mission_repository = $programMissionRepository;
        $this->mission_question_answer_base_repository = $missionQuestionAnswerBaseRepository;
    }

    public function getList($perPage = 10){
        return $this->program_repository->getAll([], $perPage);
    }

    public function findById($id){
        $mission_base = $this->program_mission_repository->getListByProgramId($id);
        foreach ($mission_base as $mission){
            $mission->answers = $this->mission_question_answer_base_repository->getByMissionBaseId($mission->mission_id);
        }
        return [
            'info' => $this->program_repository->findById($id),
            'mission_base' => $mission_base
        ];
    }
}