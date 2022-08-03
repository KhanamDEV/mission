<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\FeedbackService;
use App\Service\Api\TeamService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class FeedbackController extends Controller
{
    private $feedbackService;
    private $apiFunctionService;
    private $teamService;

    public function __construct(FeedbackService $feedbackService, ApiFunctionService $apiFunctionService, TeamService $teamService)
    {
        $this->feedbackService = $feedbackService;
        $this->apiFunctionService = $apiFunctionService;
        $this->teamService = $teamService;
    }

    /**
     * @group Feedback
     * api/v2/feedback
     * @bodyParam team_id numeric nullable The team id of feedback.
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "title": "Mission 1",
     *              "detail": "Detail mission",
     *              "percent": 0.5,
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function index(){
        try {
            if (\request()->has('team_id') && !empty(\request()->get('team_id'))){
                if (!$this->teamService->detail()) return ResponseHelpers::notFoundResponse();
                if (!$this->teamService->checkIsMember(\request()->get('team_id'))) ResponseHelpers::notFoundResponse();
            }
            return ResponseHelpers::showResponse($this->apiFunctionService->formatFeedback($this->feedbackService->getList()));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'feedback', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Feedback
     * api/v2/feedback/detail
     *
     * @bodyParam id numeric required The id of feedback
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "feedback": {
     *              "title": "Mission 1",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              },
     *               "hint_title": "Hint title",
     *               "hint_detail": "Hint detail"
     *          },
     *          "answers": [
     *              {
     *                  "title": "What is your favorite fruit?",
     *                  "list_answer": [
     *                      {
     *                          "user" : "田中圭/タナカケイ",
     *                          "type": 1,
     *                          "answer": ["Ex1","Ex2"]
     *                      },
     *                      {
     *                          "user": "田中圭/タナカケイ111",
     *                          "type": 3,
     *                          "answer": "abcd"
     *                      }
     *                  ]
     *              }
     *          ]
     *      }
     * }
     */
    public function show(){
        try {
            if (!request()->has('id')) return  ResponseHelpers::notFoundResponse();
            return  ResponseHelpers::showResponse($this->apiFunctionService->formatFeedback($this->feedbackService->findById(), 'detail'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'feedback-detail', 'message' => $e->getMessage()]);
            return  ResponseHelpers::serverErrorResponse();
        }
    }
}
