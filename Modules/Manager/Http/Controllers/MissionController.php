<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Manager\MissionService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MissionController extends Controller
{
    private $missionService;

    public function __construct(MissionService $missionService)
    {
        $this->missionService = $missionService;
    }

    public function search(){
        try {
            $id = \request()->get('id');
            $mission = $this->missionService->findById($id);
            if (!empty($mission)) return ResponseHelpers::showResponse($mission);
            return ResponseHelpers::showResponse([]);
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
