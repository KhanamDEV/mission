<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admin\MissionService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Service\Admin\ProgramService;
class ProgramController extends Controller
{
    private $program_service;
    private $missionService;
    public function __construct(ProgramService $program_service, MissionService $missionService){
        $this->program_service = $program_service;
        $this->missionService = $missionService;
    }

   public function index(){
       try {
           $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
           $data['programs'] = $this->program_service->getList(10);
           return view('admin::program.index', compact('data'));
       } catch (\Exception $e){
           abort('500');
       }
   }

    public function show($id){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['program'] = $this->program_service->findById($id);
            if (!$data['program']['info']) {
                abort(404);
            }
            return view('admin::program.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
