<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\MissionBaseService;
use App\Service\Api\MissionService;
use App\Service\Api\TeamService;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MissionController extends Controller
{
    private $missionService;
    private $apiFunctionService;
    private $teamService;

    public function __construct(MissionService $missionService, ApiFunctionService $apiFunctionService, TeamService $teamService)
    {
        $this->apiFunctionService = $apiFunctionService;
        $this->missionService = $missionService;
        $this->teamService = $teamService;
    }

    /**
     * @group Mission
     * api/v2/mission
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "answered": [
     *              {
     *                  "id": 1,
     *                  "name": "Mission 1",
     *                  "team_name": "Team 1",
     *                  "delivery_order_date": "30-09-2021",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": true,
     *                  "user_target": {
     *                      "name": "abc/xyz",
     *                      "id" : 1
     *                  }
     *              }
     *          ],
     *          "not_answered": [
     *              {
     *                  "id": 2,
     *                  "name": "Mission 2",
     *                  "team_name": "Team 2",
     *                  "delivery_order_date": "2021-09-30",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": true,
     *                  "user_target": {
     *                      "name": "abc/xyz",
     *                      "id" : 1
     *                  }
     *              },
     *              {
     *                  "id": 2,
     *                  "name": "Mission 2",
     *                  "team_name": "Team 2",
     *                  "delivery_order_date": "2021-09-30",
     *                  "thumbnail": {
     *                      "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                      "height": 1356,
     *                      "width": 2048,
     *                      "ratio": 0.75
     *                  },
     *                  "is_target": false,
     *                  "user_target": {}
     *              }
     *          ]
     *      }
     * }
     */
    public function index()
    {
        try {
            if (\request()->has('team_id') && !empty(\request()->get('team_id'))){
                if (!$this->teamService->detail()) return ResponseHelpers::notFoundResponse();
                if (!$this->teamService->checkIsMember(\request()->get('team_id'))) ResponseHelpers::notFoundResponse();
            }
            return ResponseHelpers::showResponse($this->apiFunctionService->formatMission($this->missionService->getListByUserId()));
        } catch (\Exception $e) {
            ResponseHelpers::messageSlack(['position' => 'mission', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Mission
     * api/v2/mission/question
     * type: 1 => checkbox, 2 => select, 3 => text, 4 => image
     * @bodyParam id numeric required The mission id contain question
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "mission": {
     *              "id": 1,
     *              "name": "Mission 1",
     *              "is_target": "true",
     *              "user_target": {
     *                  "id" : 1,
     *                  "name": "abc/xyz"
     *              },
     *              "time_required": "355 days"
     *          },
     *          "questions": [
     *              {
     *                  "id": 1,
     *                  "title": "What your name ?",
     *                  "type": 1,
     *                  "choice": [
     *                      "Nam",
     *                      "Cuong"
     *                  ]
     *              }
     *          ]
     *      }
     * }
     */
    public function question()
    {
        try {
            if (!request()->has('id')) return ResponseHelpers::notFoundResponse();
            return ResponseHelpers::showResponse($this->apiFunctionService->formatMissionQuestion($this->missionService->getListQuestion()));
        } catch (\Exception $e) {
            ResponseHelpers::messageSlack(['position' => 'mission-question', 'message' => $e->getMessage(), 'id' => \request()->get('id')]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Mission
     * api/v2/mission/question
     *
     * @bodyParam answers json required The json array contain answer ( [{"id":1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
     * @bodyParam mission_id numeric required The id mission of question
     * @bodyParam is_anonymous boolean required The type person answer
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function storeAnswerQuestion()
    {
        try {
            if (!request()->has('mission_id') || !\request()->has('answers')) return ResponseHelpers::notFoundResponse();
            $statusStore = $this->missionService->storeAnswerQuestion();
            return is_array($statusStore) ? ($statusStore['status'] ?  ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false], 'array', $statusStore['message'])) :
                ($statusStore ? ResponseHelpers::showResponse(['status' => true], 'array', __('api::message.mission.store_answer_success')) : ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.mission.store_answer_failed')) );
        } catch (\Exception $e) {
            ResponseHelpers::messageSlack(['position' => 'store-answer', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Mission
     * api/v2/mission/question-answered
     *
     * @bodyParam mission_id numeric required The mission base id contain question
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "mission": {
     *              "id": 1,
     *              "name": "Mission 1",
     *              "delivery_order_date": "2021-06-28",
     *              "time_required": "355 days"
     *          },
     *          "questions": [
     *              {
     *                  "id": 1,
     *                  "title": "What your name ?",
     *                  "type": "1",
     *                  "choice": [
     *                      "Nam",
     *                      "Cuong"
     *                  ]
     *              },
     *              {
     *                  "id": 2,
     *                  "title": "How old are u ?",
     *                  "type": "3",
     *                  "choice": "21"
     *              }
     *          ]
     *      }
     * }
     */
    public function showQuestionAnswered(){
        try {
            if (!\request()->has('mission_id')) return  ResponseHelpers::notFoundResponse();
            return ResponseHelpers::showResponse($this->apiFunctionService->formatMissionQuestion($this->missionService->getQuestionAnswered(), 'answered'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'show-question-answered', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Mission
     * api/v2/mission/edit-question-answered
     *
     * @bodyParam answers json required The json array contain answer ( [{"id":1,"question_id": 1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
     * @bodyParam mission_id The id of mission contain answers
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function updateQuestionAnswered(){
        try {
            if (!request()->has('mission_id') || !\request()->has('answers')) return ResponseHelpers::notFoundResponse();
            $statusStore = $this->missionService->updateQuestionAnswered();
            return is_array($statusStore) ? ($statusStore['status'] ?  ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false], 'array', $statusStore['message'])) :
                ($statusStore ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.mission.store_answer_failed')) );

        }catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'update-question', 'message' => $e->getMessage()]);
            return  ResponseHelpers::serverErrorResponse();
        }
    }
}
