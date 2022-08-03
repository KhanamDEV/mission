<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Manager\BrandNotifyService;
use App\Service\Manager\TeamService;
use App\Service\Manager\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\CreateBrandNotifyRequest;
use Modules\Manager\Http\Requests\EditBrandNotifyRequest;

class NotificationController extends Controller
{

    private $teamService;
    private $userService;
    private $brandNotifyService;

    public function __construct(TeamService $teamService, UserService $userService, BrandNotifyService $brandNotifyService)
    {
        $this->teamService = $teamService;
        $this->userService = $userService;
        $this->brandNotifyService = $brandNotifyService;
    }

    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notifies'] = $this->brandNotifyService->getList();
            return view('manager::notification.index', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function create($brand_id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['teams'] = $this->teamService->getAll(['brand_id' => $brand_id]);
            $data['users'] = $this->userService->getAll(['brand_id' => $brand_id]);
            return view('manager::notification.create', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function store(CreateBrandNotifyRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->brandNotifyService->store($data)){
                return redirect()->route('manager.notification_index', ['brand_id' => $request->route('brand_id')]);
            }
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function show($brand_id, $id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->brandNotifyService->findById($id);
            if (empty($data['notify'])) abort(404);
            return view('manager::notification.show', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function edit($brand_id, $id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->brandNotifyService->findById($id);
            $data['teams'] = $this->teamService->getList();
            $data['users'] = $this->userService->getList();
            if (empty($data['notify'])) abort(404);
            return view('manager::notification.edit', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function update(EditBrandNotifyRequest $request, $brand_id, $id)
    {
        try {
            $data = $request->all();
            if ($this->brandNotifyService->update($id, $data)){
                return redirect()->route('manager.notification_show', ['brand_id' => $brand_id, 'id' => $id]);
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
