<?php

namespace Modules\Admin\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admin\ProgramHistoryService;
use App\Service\Admin\ProgramService;
use App\Service\Admin\TeamMemberService;
use App\Service\Admin\TeamService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{
    private $teamService, $teamMemberService, $programHistoryService;

    public function __construct(TeamService $teamService, TeamMemberService $teamMemberService, ProgramHistoryService $programHistoryService)
    {
        $this->teamService = $teamService;
        $this->teamMemberService = $teamMemberService;
        $this->programHistoryService = $programHistoryService;
    }

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['teams'] = $this->teamService->getList(10);
            return view('admin::team.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($id){
        try {
            $data['team'] = $this->teamService->findById($id);
            if (empty($data['team'])) abort('404');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['users'] = $this->teamMemberService->getListByTeamId($id);
            $data['program'] = $this->teamService->getProgramByTeamId($id);
            $data['program_history'] = $this->programHistoryService->getListByTeamId($id);
            return view('admin::team.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
