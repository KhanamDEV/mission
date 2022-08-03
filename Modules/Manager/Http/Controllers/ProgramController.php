<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Manager\ProgramMissionService;
use App\Service\Manager\ProgramService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\EditProgramRequest;

class ProgramController extends Controller
{
    private $programService;
    private $programMissionService;

    public function __construct(ProgramService $programService, ProgramMissionService $programMissionService)
    {
        $this->programService = $programService;
        $this->programMissionService = $programMissionService;
    }

    public function index(){
        try {
            $data['programs'] = $this->programService->getList(10);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::program.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Create program
     * @method GET
     */
    public function create(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::program.create', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Create program
     * @method POST
     */
    public function store(Request $request){
        try {
            $data = $request->all();
            $programId = $this->programService->store($data);
            if ($programId) return redirect()->route('manager.program_show', ['id' => $programId]);
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Edit program
     * @method GET
     */
    public function edit($id){
        try {
            $data['program'] = $this->programService->findById($id);
            if (empty($data['program'])) abort('404');
            $data['program_mission'] = $this->programMissionService->getListByProgramId($id);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::program.edit', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Edit program
     * @method POST
     */
    public function update(EditProgramRequest $request, $id){
        try {
            $data = $request->all();
            if ($this->programService->update($id, $data)){
                return redirect()->route('manager.program_show', ['id' => $id]);
            }
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($id){
        try {
            $data['program'] = $this->programService->findById($id);
            if (empty($data['program'])) abort('404');
            $data['program_mission'] = $this->programMissionService->getListByProgramId($id);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::program.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
