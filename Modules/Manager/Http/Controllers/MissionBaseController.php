<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Service\Manager\MissionBaseService;
use App\Helpers\ResponseHelpers;
use Modules\Manager\Http\Requests\MissionBaseRequest;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\UpdateMissionBaseRequest;

class MissionBaseController extends Controller
{
    private $mission_base_service;

    public function __construct(MissionBaseService $mission_base_service){
        $this->mission_base_service = $mission_base_service;
    }


    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['missions'] = $this->mission_base_service->getList();
            return view('manager::mission_base.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function create(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::mission_base.create', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }


    public function show($id){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['mission'] = $this->mission_base_service->findById($id);
            if (!$data['mission']) {
                abort("404");
            }
            return view('manager::mission_base.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function store(MissionBaseRequest $request){
        try {
            $new_mission_id = $this->mission_base_service->store($request);
            if (!$new_mission_id) {
                $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
                return redirect()->back()->withInput($request->all())->withErrors($errors);
            }
            return redirect()->route('manager.mission_base.show', $new_mission_id);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function edit($id){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['mission'] = $this->mission_base_service->findById($id);
            if (!$data['mission']) {
                abort("404");
            }
            return view('manager::mission_base.edit', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function update($id, UpdateMissionBaseRequest $request){
        try {
            $id = $this->mission_base_service->update($id, $request);
            if (!$id) {
                $errors = new MessageBag(['updateFail' => 'message.response.an_error_has_occurred']);
                return redirect()->back()->withInput($request->all())->withErrors($errors);
            }
            return redirect()->route('manager.mission_base.show', $id);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function destroy($id){
        try {
            $status = $this->mission_base_service->destroy($id);
            if (!$status) {
                return ResponseHelpers::serverErrorResponse([], 'array', "Internal Server Error");
            }
            return ResponseHelpers::showResponse([], 'array', "Success");
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse([], 'array', "Internal Server Error");
        }
    }

    public function search(){
        try {
            $id = \request()->get('id');
            $mission = $this->mission_base_service->findById($id);
            if (!empty($mission)) return ResponseHelpers::showResponse($mission);
            return ResponseHelpers::showResponse([]);
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
