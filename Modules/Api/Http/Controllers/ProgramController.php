<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\ProgramService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProgramController extends Controller
{

    private $programService;
    private $apiFunctionService;

    public function __construct(ProgramService $programService, ApiFunctionService $apiFunctionService)
    {
        $this->programService = $programService;
        $this->apiFunctionService = $apiFunctionService;
    }

    /**
     * @group Program
     * api/v2/program
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name": "Program 1",
     *              "detail": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure molestiae voluptate at ab quae, maiores assumenda sapiente accusamus repellendus ea sint. Corporis laborum deleniti dolor doloribus a molestias esse nostrum?",
     *              "thumbnail": {
     *                  "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *                  "height": 1536,
     *                  "width": 2048,
     *                  "ratio": 0.75
     *              }
     *          }
     *      ]
     * }
     */
    public function index(){
        try {
            return  ResponseHelpers::showResponse($this->apiFunctionService->formatProgram($this->programService->getList()));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'program', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Program
     * api/v2/program/detail
     *
     * @bodyParam id numeric required The id of program
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "name": "Program 1",
     *          "detail": "Detail program 1",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function show(){
        try {
            if (!\request()->has('id')) return  ResponseHelpers::notFoundResponse();
            return  ResponseHelpers::showResponse($this->apiFunctionService->formatProgram($this->programService->findById(),'detail'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'program-detail', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
