<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Admin\BrandNotifyService;
use App\Service\Admin\TeamService;
use App\Service\Admin\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Admin\Http\Requests\CreateNotificationRequest;
use Modules\Admin\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{

    private $brandNotifyService;
    private $teamService;
    private $userService;

    public function __construct(BrandNotifyService $brandNotifyService, TeamService $teamService,
                                UserService $userService)
    {
        $this->brandNotifyService = $brandNotifyService;
        $this->teamService = $teamService;
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notifies'] = $this->brandNotifyService->getList();
            return view('admin::notification.index', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['teams'] = $this->teamService->getAll();
            $data['users'] = $this->userService->getAll();
            return view('admin::notification.create', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function store(CreateNotificationRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->brandNotifyService->store($data)){
                return redirect()->route('admin.notification_index');
            }
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function show($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->brandNotifyService->findById($id);
            if (empty($data['notify'])) abort(404);
            return view('admin::notification.show', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->brandNotifyService->findById($id);
            $data['teams'] = $this->teamService->getAll();
            $data['users'] = $this->userService->getAll();
            if (empty($data['notify'])) abort(404);
            return view('admin::notification.edit', compact('data'));
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function update(UpdateNotificationRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($this->brandNotifyService->update($id, $data)){
                return redirect()->route('admin.notification_show', ['id' => $id]);
            }
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $data = $request->all();
            return $this->brandNotifyService->delete($data['id']) ? ResponseHelpers::showResponse() : ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
