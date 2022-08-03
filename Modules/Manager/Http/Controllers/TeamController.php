<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Manager\ProgramHistoryService;
use App\Service\Manager\TeamMemberService;
use App\Service\Manager\TeamService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{

    private $teamService;
    private $programHistoryService;
    private $teamMemberService;

    public function __construct(TeamService $teamService, ProgramHistoryService $programHistoryService,
                                TeamMemberService $teamMemberService)
    {
        $this->teamService = $teamService;
        $this->programHistoryService = $programHistoryService;
        $this->teamMemberService = $teamMemberService;
    }

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['teams'] = $this->teamService->getList();
            return view('manager::team.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($brandId, $id){
        try {
            $data['team'] = $this->teamService->findById($id);
            if (empty($data['team']['info'])) abort('404');
            $data['program_history'] = $this->programHistoryService->getListByTeamId($id);
            $data['users'] = $this->teamMemberService->getListByTeamId($brandId, $id);
            $data['program'] = $this->teamService->getProgramByTeamId($id);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::team.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function getListByBrand(Request $request){
        try {
            $data = $request->all();
            return ResponseHelpers::showResponse($this->teamService->getAll(['brand_id' => $data['brand_id']]));
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
