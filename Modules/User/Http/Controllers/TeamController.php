<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\User\ProgramHistoryService;
use App\Service\User\TeamMemberService;
use App\Service\User\TeamService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{

    private $teamService;
    private $teamMemberService;
    private $programHistoryService;

    public function __construct(TeamService $teamService, TeamMemberService $teamMemberService, ProgramHistoryService $programHistoryService)
    {
        $this->teamService = $teamService;
        $this->teamMemberService = $teamMemberService;
        $this->programHistoryService = $programHistoryService;
    }

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['teams'] = $this->teamService->getListByBrandId(10);
            return view('user::team.index', compact(['data']));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($id){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['team'] = $this->teamService->findById($id);
            if(empty($data['team'])) abort(404);
            $data['users'] = $this->teamMemberService->getListByTeamId($id);
            $data['program'] = $this->teamService->getProgramByTeamId($id);
            $data['program_history'] = $this->programHistoryService->getListByTeamId($id);
            return view('user::team.show', compact(['data']));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
