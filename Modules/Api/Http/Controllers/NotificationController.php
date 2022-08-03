<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\NotificationService;
use App\Service\Api\UserService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    private $notificationService;
    private $apiFunctionService;
    private $userService;

    public function __construct(NotificationService $notificationService, ApiFunctionService $apiFunctionService, UserService $userService)
    {
        $this->notificationService = $notificationService;
        $this->apiFunctionService = $apiFunctionService;
        $this->userService = $userService;
    }

    /**
     * @group Notification
     * api/v2/notification
     * @bodyParam type string not required Ex: system, brand
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "brand": [
     *              {
     *                  "id": 1,
     *                  "title": "Notify 1",
     *                  "is_seen": "false",
     *                  "created_at": "2021/11/23"
     *              }
     *          ],
     *          "system": [
     *              {
     *                  "id": 2,
     *                  "title": "Notify 2",
     *                  "is_seen": "true",
     *                  "created_at": "2021/09/30"
     *              }
     *          ]
     *      }
     * }
     */
    public function index()
    {
        try {
            if (!$this->userService->resetNumberNotify()) return ResponseHelpers::serverErrorResponse();
            if (\request()->has('type') && !empty(\request()->get('type'))){
                return ResponseHelpers::showResponse($this->apiFunctionService->formatNotification($this->notificationService->getListByType(\request()->get('type')), 'type'));
            }
            return ResponseHelpers::showResponse($this->apiFunctionService->formatNotification($this->notificationService->getList()));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'notification', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group Notification
     * api/v2/notification/detail
     *
     * @bodyParam id numeric The id of notification
     * @bodyParam type string Type of notification Ex: brand, system
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "title": "Title",
     *          "description": "Description",
     *          "url": "url"
     *      }
     * }
     */
    public function show(){
        try {
            if (!\request()->has('id') || !\request()->has('type')) return ResponseHelpers::notFoundResponse();
            $notify = $this->notificationService->findById(\request()->get('id'), \request()->get('type'));
            return $notify ? ResponseHelpers::showResponse($this->apiFunctionService->formatNotification($notify, 'detail')) :
                ResponseHelpers::notFoundResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'notification-detail', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

}
