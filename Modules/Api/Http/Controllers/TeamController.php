<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\TeamService;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{

    private $teamService;
    private $apiFunctionService;

    public function __construct(TeamService $teamService, ApiFunctionService $apiFunctionService)
    {
        $this->teamService = $teamService;
        $this->apiFunctionService = $apiFunctionService;
    }

    /**
     * @group Team
     * api/v2/team
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "Team 1",
     *              "detail": "Detail team 1",
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
    public function index()
    {
        try {
            return ResponseHelpers::showResponse($this->apiFunctionService->formatTeam($this->teamService->getList()));
        } catch (\Exception $e) {
            ResponseHelpers::messageSlack(['position' => 'team', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/create
     *
     * @bodyParam data json required The data create team ({"team":{"thumbnail_url":"url image","name":"Team 1"},"users":[{"id":1,"is_leader":true}],"program_id":1})
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
    public function store()
    {
        try {
            if (!\request()->has('data')) return ResponseHelpers::notFoundResponse();
            $team = $this->teamService->store();
            return $team['status'] ? ResponseHelpers::showResponse(['status' => true, 'team_id' => $team['id']]) :
                ResponseHelpers::serverErrorResponse(['status' => false], 'array', $team['message']);
        } catch (\Exception $e) {
            ResponseHelpers::messageSlack(['position' => 'create-team', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/edit
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam name string required The name of team
     * @bodyParam thumbnail_url string The url image thumbnail team
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
    public function update(){
        try {
            if (!\request()->has('team_id') || !\request()->has('name') || !\request()->has('thumbnail_url')) return ResponseHelpers::notFoundResponse();
            if (!$this->teamService->checkIsLeader(\request()->get('team_id'))) return ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.error_only_leader_change'));
            return $this->teamService->update() ? ResponseHelpers::showResponse(['status' => true]) :
                ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.edit_failed'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'team-update', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/member
     *
     * @bodyParam id numeric required The id of team
     * @bodyParam type string  The type get member (get for show, get for edit) Ex:  edit
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "KhaNam/KhaNam",
     *              "name_sei": "Kha",
     *              "name_mei": "Nam",
     *              "is_team_member": 1,
     *              "is_leader": 1,
     *              "position": "member",
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
    public function member(){
        try {
            if (!\request()->has('id')) return  ResponseHelpers::notFoundResponse();
            return  ResponseHelpers::showResponse($this->apiFunctionService->formatMember($this->teamService->getListMemberByTeamId()));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'team-member', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/member/detail
     *
     * @bodyParam id numeric required The id of member
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name_sei": "Kha",
     *          "name_mei": "Nam",
     *          "name_sei_kana": "Kha",
     *          "name_mei_kana": "Nam",
     *          "name": "Kha Nam / Kha Nam",
     *          "department": "department",
     *          "detail": "This is detail",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function showMember(){
        try {
            if (!\request()->has('id')) return ResponseHelpers::notFoundResponse();
            return  ResponseHelpers::showResponse($this->apiFunctionService->formatMember($this->teamService->detailMember(), 'detail'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'member-detail', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/detail
     *
     * @bodyParam id numeric required The id of team
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name": "Team 1",
     *          "program_id": 1,
     *          "program_name": "Program 1",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function detail(){
        try {
            if (!\request()->has('id')) return ResponseHelpers::notFoundResponse();
            $team = $this->teamService->detail();
            if (!$team) return ResponseHelpers::notFoundResponse();
            return ResponseHelpers::showResponse($this->apiFunctionService->formatTeam($team, 'detail'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'team-detail', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/edit-program
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam program_id numeric required The program id
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
    public function updateProgram(){
        try {
            if (\request()->has('team_id') && \request()->has('program_id')){
                if (!$this->teamService->checkIsLeader(\request()->get('team_id'))) return ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.error_only_leader_change'));
                return $this->teamService->updateProgram() ? ResponseHelpers::showResponse(['status' => true]) :
                    ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.edit_program_failed'));
            }
            return ResponseHelpers::notFoundResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'update-program', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/edit-member
     *
     * @bodyParam team_id numeric required The team id
     * @bodyParam members json required The data user ( [{"id":1,"is_leader":true}] )
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
    public function updateMember(){
        try {
            if (request()->has('team_id') && \request()->has('members') ){
                if (!$this->teamService->checkIsLeader(\request()->get('team_id'))) return ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.error_only_leader_change'));
                $team = $this->teamService->updateMember();
                return $team['status'] ? ResponseHelpers::showResponse(['status' => true]) :
                    ResponseHelpers::serverErrorResponse(['status' => false], 'array', $team['message']);
            }
            return ResponseHelpers::notFoundResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'update-member', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Team
     * api/v2/team/delete
     *
     * @bodyParam team_id numeric required The team id
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
    public function destroy(){
        try {
            if (!\request()->has('team_id')) return  ResponseHelpers::notFoundResponse();
            return $this->teamService->delete() ? ResponseHelpers::showResponse(['status'=> true]) :
                ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.team.edit_member_failed'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'delete', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
