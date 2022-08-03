<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Imports\UsersImport;
use App\Service\Admin\BrandNotifyService;
use App\Service\Admin\LogUpdateUserService;
use App\Service\Admin\MissionQuestionAnswerService;
use App\Service\Admin\MissionService;
use App\Service\Admin\SystemNotifyService;
use App\Service\Admin\TeamService;
use App\Service\Admin\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Http\Requests\AdminUploadDataUserRequest;

class UserController extends Controller
{
    private $userService;
    private $missionService;
    private $logUpdateUserService;
    private $teamService;
    private $missionQuestionAnswerService;
    private $brandNotifyService;
    private $systemNotifyService;


    public function __construct(UserService $userService, MissionService $missionService, LogUpdateUserService $logUpdateUserService,
                                TeamService $teamService, MissionQuestionAnswerService $missionQuestionAnswerService,
                                BrandNotifyService $brandNotifyService, SystemNotifyService $systemNotifyService)
    {
        $this->userService = $userService;
        $this->missionService = $missionService;
        $this->logUpdateUserService = $logUpdateUserService;
        $this->teamService = $teamService;
        $this->missionQuestionAnswerService = $missionQuestionAnswerService;
        $this->brandNotifyService = $brandNotifyService;
        $this->systemNotifyService = $systemNotifyService;
    }

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['users'] = $this->userService->getList(10);
            return view('admin::user.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function create(){
        try {
            if(!empty($this->userService->getList()->count())) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::user.create', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function store(Request $request){
        try {
            return $this->userService->create($request->all()) ? ResponseHelpers::showResponse() : ResponseHelpers::clientBEErrorResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }

    public function edit(){
        try {
            if(empty($this->userService->getList()->count())) abort(404);
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['log_update'] = $this->logUpdateUserService->getList();
            return view('admin::user.update', compact('data'));
        } catch (\Exception $e){

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

    public function show($id){
        try {
            $data['user'] = $this->userService->findById($id);
            if (empty($data['user'])) abort(404);
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['teams'] = $this->teamService->getListByUserId($id);
            $data['missions'] = $this->missionQuestionAnswerService->getListMissionByUserId($id);
            $data['brand_notifies'] = $this->brandNotifyService->getListByUser($id, 2);
            $data['system_notifies'] =  $this->systemNotifyService->getListByUserId($id, 2);
            return view('admin::user.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function mission($userId, $id){
        try {
            $data['user'] = $this->userService->findById($userId);
            if(empty($data['user'])) abort(404);
            $data['mission'] = $this->missionService->show($id);
            if (empty($data['mission'])) abort(404);
            $data['question_answers'] = $this->missionQuestionAnswerService->getListByUserId($userId, $id);
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            return view('admin::user.mission', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function showSystemNotification($userId, $id){
        try {
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['notify'] = $this->systemNotifyService->findById($id);
            if (empty($data['notify'])) abort(404);
            return view('admin::user.system_notification', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function getSystemNotification(){
        try {
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['notifies'] = $this->systemNotifyService->getList();
            return view('admin::user.system_notification_index', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function getBrandNotification($userId){
        try {
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['notifies'] = Helpers::paginate($this->brandNotifyService->getListByUser($userId));
            return view('admin::user.brand_notification', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    public function showbrandNotification($userId, $id){
        try {
            $data['common'] = Helpers::titleAction([__('admin::layer.sidebar.user')]);
            $data['notify'] = $this->brandNotifyService->findById($id);
            if (empty($data['notify'])) abort(404);
            return view('admin::user.brand_notification_detail', compact('data'));
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
