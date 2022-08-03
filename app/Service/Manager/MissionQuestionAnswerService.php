<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 16/06/2021
 * Time: 11:14
 */

namespace App\Service\Manager;


use App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;

class MissionQuestionAnswerService
{
    private $missionQuestionAnswerRepository;

    public function __construct(MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository)
    {
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
    }

    public function getListByMissionId($id){
        $questionAnswer = $this->missionQuestionAnswerRepository->getListByMissionId($id);
        foreach ($questionAnswer as $value){
            if ($value->type == 1 || $value->type == 2){
                $value->answer = explode(",", $value->answer);
            }
        }
        return $questionAnswer;
    }

    public function getListByUserId($id,$missionId){
        $questionAnswer = $this->missionQuestionAnswerRepository->getListByUserId($id,$missionId);
        foreach ($questionAnswer as $value){
            if ($value->type == 1 || $value->type == 2){
                $value->answer = explode(",", $value->answer);
            }
        }
        return $questionAnswer;
    }

    public function getListMissionByUserId($userId){
        return $this->missionQuestionAnswerRepository->getListMissionByUserId($userId);
    }

}