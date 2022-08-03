<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Jobs\SendNotificationNewFeedback;
use App\Jobs\SendNotificationNewMissionJob;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\ApiUploadService;
use App\Service\Api\FeedbackService;
use App\Service\Api\MissionService;
use App\Service\Api\UserService;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class UserController extends Controller
{


    private $userService;
    private $apiFunctionService;

    public function __construct(UserService $userService, ApiFunctionService $apiFunctionService, ApiUploadService $apiUploadService)
    {
        $this->userService = $userService;
        $this->apiFunctionService = $apiFunctionService;
        $this->apiUploadService = $apiUploadService;
    }

    /**
     * @group User
     * api/v2/user/detail
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "name_sei": "Kha",
     *          "name_mei": "Nam",
     *          "name_sei_kana": "Kha kana",
     *          "name_mei_kana": "Nam kana",
     *          "detail": "Detail",
     *          "thumbnail": {
     *              "url": "https://missionimg.s3-ap-northeast-1.amazonaws.com/321.jpg",
     *              "height": 1536,
     *              "width": 2048,
     *              "ratio": 0.75
     *          }
     *      }
     * }
     */
    public function detail(){
        try {
            return ResponseHelpers::showResponse($this->apiFunctionService->formatUser($this->userService->detail(), 'detail'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'user-detail', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user/edit
     *
     * @bodyParam name_sei string
     * @bodyParam name_mei string
     * @bodyParam name_sei_kana string
     * @bodyParam name_mei_kana string
     * @bodyParam detail string
     * @bodyParam thumbnail_url string
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function update(){
        try {
            if (!\request()->has('name_sei') || !\request()->has('name_mei') || !\request()->has('name_sei_kana') ||
                !\request()->has('name_mei_kana') || !\request()->has('detail') || !\request()->has('thumbnail_url')) return ResponseHelpers::notFoundResponse();
            $update = $this->userService->update();
            return is_array($update) ? ResponseHelpers::serverErrorResponse(['status' => $update['status']], 'array', $update['message']) :
                ($update ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse()) ;
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'user-update', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user/upload-avatar
     * @bodyParam thumbnail_url string required The image of user
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存に失敗しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function updateAvatar(){
        try {
            if (!\request()->has('thumbnail_url')) return ResponseHelpers::notFoundResponse();
            return $this->userService->update('avatar') ? ResponseHelpers::showResponse(['status' => true]) :
                ResponseHelpers::serverErrorResponse(['status' => false], 'array', __('api::message.user.upload_avatar_false'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'user-avatar', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": [
     *          {
     *              "id": 1,
     *              "name_sei": "name sei",
     *              "name_mei": "name mei",
     *              "name_sei_kana": "name sei kana",
     *              "name_mei_kana": "name mei kana",
     *              "thumbnail": {
     *                  "url": "url image",
     *                  "height": 1365,
     *                  "width": 720,
     *                  "ratio": 2
     *              }
     *          }
     *      ]
     * }
     */
    public function index(){
        try {
            return ResponseHelpers::showResponse($this->apiFunctionService->formatUser($this->userService->getList(), 'list'));
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'user-index', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user/update-push-notification-token
     * @bodyParam token string required
     * @bodyParam device string required Ex: android, iOS
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function updatePushNotificationToken(){
        try {
            if (!\request()->has('token')) return  ResponseHelpers::notFoundResponse();
            return $this->userService->update('push_notification_token') ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false]);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'update-push-notification', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user/remove-push-notification-token
     * @bodyParam token string required
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     * @response 500{
     *      "meta": {
     *          "status": 500,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function removePushNotificationToken(){
        try {
            if (!\request()->has('token')) return  ResponseHelpers::notFoundResponse();
            return $this->userService->removePushNotificationToken() ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false]);
        } catch (Exception $e){
            ResponseHelpers::messageSlack(['position' => 'update-push-notification', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group User
     * api/v2/user/send-notification
     * @bodyParam user_id int id of user receive notify
     * @bodyParam type string Ex: beer
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     */
    public function send(){
        try{
            if ($this->userService->sendNotification()) return ResponseHelpers::showResponse(['status' => true]);
            return ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'send-notification', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    public function getPushToken(){
        try {
            $userId = \request()->get('user_id');
            $pushToken = DB::table('users')->where('id', $userId)->first()->push_notification_token;
            return ResponseHelpers::showResponse(['token' => $pushToken == null ? null : @json_decode($pushToken)]);
        } catch (\Exception $e){
            return ResponseHelpers::showResponse($e->getMessage());
        }
    }

    public function sendNotificationDaily(MissionService $missionService, FeedbackService $feedbackService){
        try {
            $missions = $missionService->getMissionDaily();
            foreach ($missions as $mission){
                foreach ($mission->user_push_notification as $user){
                    $jobSendNotificationMission = new SendNotificationNewMissionJob($mission, $user);
                    dispatch($jobSendNotificationMission)->delay(now()->addSeconds(2));
                }
            }
        } catch (\Exception $e){
            dd($e);
        }
    }


    /**
     * @group User
     * api/v2/user/reset-number-notification
     * @bodyParam id
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "status": true
     *      }
     * }
     */
    public function resetNotification(){
        try {
            return $this->userService->resetNumberNotify() ? ResponseHelpers::showResponse() : ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'reset-token', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    public function getNotifyCount(){
        try {
            return ResponseHelpers::showResponse(["notity_count" => 15]);
        } catch (\Exception $e){
            return ResponseHelpers::showResponse($e->getMessage());

        }
    }
}