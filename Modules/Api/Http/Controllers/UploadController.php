<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiUploadService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UploadController extends Controller
{
    private $apiUploadService;

    public function __construct(ApiUploadService $apiUploadService)
    {
        $this->apiUploadService = $apiUploadService;
    }

    /**
     * @group Upload
     * api/v2/upload-image
     * @bodyParam image base64 required The image
     * @bodyParam type string required The type of image Ex: question, team,...
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "url": "url image"
     *      }
     * }
     */
    public function upload(){
        try {
            if(!\request()->has('image') || !\request()->has('type')) return ResponseHelpers::notFoundResponse();
            $image = $this->apiUploadService->uploadImage(\request()->get('image'), \request()->get('type'));
            if (is_array($image)) return ResponseHelpers::serverErrorResponse(['status' => $image['status']],'array' , $image['message']);
            return ResponseHelpers::showResponse(['url' => $image]);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'upload', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
