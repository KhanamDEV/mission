<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\User\LogUpdateUserService;
use App\Service\User\Mission\MissionService;
use App\Service\User\MissionQuestionAnswerService;
use App\Service\User\TeamService;
use App\Service\User\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\AbstractList;

class UserController extends Controller
{

    private $userService;
    private $missionService;
    private $teamService;
    private $missionQuestionAnswerService;
    private $logUpdateUserService;

    public function __construct(UserService $userService, MissionService $missionService, TeamService $teamService,
                                MissionQuestionAnswerService $missionQuestionAnswerService,
                                LogUpdateUserService $logUpdateUserService)
    {
        $this->userService = $userService;
        $this->missionService = $missionService;
        $this->teamService = $teamService;
        $this->missionQuestionAnswerService = $missionQuestionAnswerService;
        $this->logUpdateUserService = $logUpdateUserService;
    }

    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['users'] = $this->userService->getList();
            return view('user::user.index', compact(['data']));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function show($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['user'] = $this->userService->findById($id);
            if (empty($data['user'])) abort(404);
            $data['teams'] = $this->teamService->getByUserId($id);
            $data['missions'] = $this->missionQuestionAnswerService->getListMissionByUserId($id);
            return view('user::user.show', compact(['data']));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function mission($userId, $id)
    {
        try {
            $data['user'] = $this->userService->findById($userId);
            if (empty($data['user'])) abort(404);
            $data['mission'] = $this->missionService->findById($id);
            if (empty($data['mission'])) abort('404');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['question_answers'] = $this->missionQuestionAnswerService->getListByUserId($userId, $id);
            return view('user::user.mission', compact(['data']));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function edit()
    {
        try {
            if (!Auth::guard('user')->user()->is_admin) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['log_update'] = $this->logUpdateUserService->getList();
            return view('user::user.update', compact(['data']));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function update(Request $request){
        try {
            return $this->userService->update($request->all()) ? ResponseHelpers::showResponse() : ResponseHelpers::clientBEErrorResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }

    public function destroy(Request $request){
        try {
            $data = $request->all();
            if ($this->userService->delete($data['id'])) return ResponseHelpers::showResponse();
            return ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
