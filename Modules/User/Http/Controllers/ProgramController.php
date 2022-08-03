<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\User\ProgramService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProgramController extends Controller
{
    private $programService;

    public function __construct(ProgramService $programService){
        $this->programService = $programService;
    }

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['programs'] = $this->programService->getList();
            return view('user::program.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($id){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['program'] = $this->programService->findById($id);
            if (empty($data['program'])) abort(404);
            return view('user::program.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
