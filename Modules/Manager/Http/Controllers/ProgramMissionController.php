<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Manager\ProgramMissionService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProgramMissionController extends Controller
{

    private $programMissionService;

    public function __construct(ProgramMissionService $programMissionService)
    {
        $this->programMissionService = $programMissionService;
    }

    public function destroy(){
        try {
            if (request()->has('id')){
                if ($this->programMissionService->delete(\request()->get('id'))){
                    return ResponseHelpers::showResponse(true);
                }
                return ResponseHelpers::serverErrorResponse();
            }
            return ResponseHelpers::notFoundResponse();
        } catch (\Exception $e){
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
