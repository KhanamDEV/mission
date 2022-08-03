<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Manager\BrandService;
use App\Service\Manager\SystemNotifyService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\CreateSystemNotifyRequest;
use Modules\Manager\Http\Requests\EditSystemNotifyRequest;

class NoticeManagementController extends Controller
{

    private $userService;
    private $teamService;
    private $brandService;
    private $systemNotifyService;

    public function __construct(BrandService $brandService, SystemNotifyService $systemNotifyService)
    {
        $this->brandService = $brandService;
        $this->systemNotifyService = $systemNotifyService;
    }

    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notifies'] = $this->systemNotifyService->getList();
            return view('manager::notice_management.index', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['brands'] = $this->brandService->getAll();
            return view('manager::notice_management.create', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function store(CreateSystemNotifyRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->systemNotifyService->store($data)){
                return redirect()->route('manager.notice_management_index');
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
            $data['notify'] = $this->systemNotifyService->findById($id);
            if (empty($data['notify'])) abort(404);
            return view('manager::notice_management.show', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function edit($id)
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['notify'] = $this->systemNotifyService->findById($id);
//            dd($data['notify']);
            $data['brands'] = $this->brandService->getAll();
            if (empty($data['notify'])) abort(404);
            return view('manager::notice_management.edit', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }


    public function update(EditSystemNotifyRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($this->systemNotifyService->update($id, $data)){
                return redirect()->route('manager.notice_management_show', ['id' => $id]);
            }
            $errors = new MessageBag(['updateFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort(500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $data = $request->all();
            return $this->systemNotifyService->delete($data['id']) ? ResponseHelpers::showResponse() : ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
