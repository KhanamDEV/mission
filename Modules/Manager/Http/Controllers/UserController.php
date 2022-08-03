<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Manager\BrandNotifyService;
use App\Service\Manager\LogUpdateUserService;
use App\Service\Manager\MissionQuestionAnswerService;
use App\Service\Manager\MissionService;
use App\Service\Manager\SystemNotifyService;
use App\Service\Manager\TeamService;
use App\Service\Manager\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    private $userService;
    private $logUpdateUserService;
    private $teamService;
    private $missionService;
    private $missionQuestionAnswerService;
    private $brandNotifyService;
    private $systemNotifyService;

    public function __construct(UserService $userService, LogUpdateUserService $logUpdateUserService,
                                TeamService $teamService, MissionService $missionService,
                                MissionQuestionAnswerService $missionQuestionAnswerService,
                                BrandNotifyService $brandNotifyService, SystemNotifyService $systemNotifyService)
    {
        $this->userService = $userService;
        $this->logUpdateUserService = $logUpdateUserService;
        $this->teamService = $teamService;
        $this->missionService = $missionService;
        $this->missionQuestionAnswerService = $missionQuestionAnswerService;
        $this->brandNotifyService = $brandNotifyService;
        $this->systemNotifyService = $systemNotifyService;
    }

    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['users'] = $this->userService->getList();
            return view('manager::user.index', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Create user
     * @method GET
     */
    public function create()
    {
        try {
            if (!empty($this->userService->getList()->count())) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::user.create', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Create user
     * @method POST
     */
    public function store(Request $request)
    {
        try {
            return $this->userService->create($request->all()) ? ResponseHelpers::showResponse() : ResponseHelpers::clientBEErrorResponse();
        } catch (\Exception $e) {
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * Edit user
     * @method GET
     */
    public function edit()
    {
        try {
            if (empty($this->userService->getList())) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['logUpdateUsers'] = $this->logUpdateUserService->getList();
            return view('manager::user.edit', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Edit user
     * @method POST
     */
    public function update(Request $request)
    {
        try {
            return $this->userService->update($request->all()) ? ResponseHelpers::showResponse() : ResponseHelpers::clientBEErrorResponse();
        } catch (\Exception $e) {
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * Show user
     * @method GET
     */
    public function show($brandId, $id)
    {
        try {
            $data['user'] = $this->userService->findById($id);
            if (empty($data['user'])) abort(404);
            $data['teams'] = $this->teamService->getListByUserId($id);
            $data['missions'] = $this->missionQuestionAnswerService->getListMissionByUserId($id);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['brand_notifies'] = $this->brandNotifyService->getListByUser($id, $brandId, 2);
            $data['system_notifies'] = $this->systemNotifyService->getListByUser($id, $brandId, 2);
            return view('manager::user.show', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function showMission($brandId, $userId, $id)
    {
        try {
            $data['user'] = $this->userService->findById($userId);
            if (empty($data['user'])) abort(404);
            $data['mission'] = $this->missionService->findById($id);
            if (empty($data['mission'])) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['questions'] = $this->missionQuestionAnswerService->getListByUserId($userId,$id);
            return view('manager::user.mission_show', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function getListByBrand(Request $request){
        try {
            $data = $request->all();
            return ResponseHelpers::showResponse($this->userService->getAll($data));
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }

    public function brandNotification($brandId, $userId){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notifies'] = Helpers::paginate($this->brandNotifyService->getListByUser($userId, $brandId));
            return view('manager::user.brand_notification', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function systemNotification($brandId, $userId){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify_system'] = Helpers::paginate($this->systemNotifyService->getListByUser($userId, $brandId));
            return view('manager::user.system_notification', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function brandNotificationDetail($brandId, $userId, $notifyId){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->brandNotifyService->findById($notifyId);
            return view('manager::user.brand_notification_detail', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function systemNotificationDetail($brandId, $userId, $notifyId){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->systemNotifyService->findById($notifyId);
            return view('manager::user.system_notification_detail', compact('data'));
        } catch (\Exception $e){
            abort(500);
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
