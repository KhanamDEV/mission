<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 09/06/2021
 * Time: 13:15
 */

namespace App\Service\Admin;


use App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;

class MissionQuestionAnswerService
{
    private $missionQuestionAnswerRepository;

    public function __construct(MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository)
    {
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
    }

    public function getListByMissionId($missionId){
        //type = 1 : Checkbox
        //type = 2 : Select
        //type = 3 : Text
        $questionAnswer = $this->missionQuestionAnswerRepository->getListByMissionId($missionId);
        foreach ($questionAnswer as $value){
            if ($value->type == 1 || $value->type == 2){
                $value->answer = explode(",", $value->answer);
            }
        }
        return $questionAnswer;
    }

    public function getListByUserId($id, $missionId){
        //type = 1 : Checkbox
        //type = 2 : Select
        //type = 3 : Text
        $questionAnswer = $this->missionQuestionAnswerRepository->getListByUserId($id, $missionId);
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