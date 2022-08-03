<?php

namespace Modules\Api\Http\Controllers\Auth;

use App\Helpers\ResponseHelpers;
use App\Service\Api\PasswordService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PasswordController extends Controller
{
    private $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * @group ForgetPassword
     * api/v2/forget-password
     * @bodyParam email string required The email of brand account
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
     * @response 401{
     *      "meta": {
     *          "status": 401,
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function confirmMail(Request $request){
        try {
            $data = $request->only('email');
            if (!$this->passwordService->checkHasUserByEmail($data['email']))
                return ResponseHelpers::authenticateErrorResponse(__('api::message.forget_password.email_not_use'));
            return $this->passwordService->confirmMail($data) ? ResponseHelpers::showResponse(['status' => true]) :
                ResponseHelpers::serverErrorResponse();
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'forget-password', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group ForgetPassword
     * api/v2/forget-password/confirm
     * @bodyParam email string required The email of brand account
     * @bodyParam token string required The token send to mail
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
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function confirmToken(Request $request){
        try {
            $data = $request->only('token', 'email');
            $confirm = $this->passwordService->confirmToken($data);
            return $confirm['status'] ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false], 'array', $confirm['message']);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'confirm-token', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }

    /**
     * @group ForgetPassword
     * api/v2/forget-password/change
     * @bodyParam email string required The email of brand account
     * @bodyParam password string required The new password of brand account
     * @bodyParam token string required The token send to mail
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
     *          "message": "内部サーバーエラー"
     *      },
     *      "response": {
     *          "status": false
     *      }
     * }
     */
    public function changePassword(Request $request){
        try {
            $data = $request->only('password', 'email', 'token');
            return $this->passwordService->changePassword($data) ? ResponseHelpers::showResponse(['status' => true]) : ResponseHelpers::serverErrorResponse(['status' => false]);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'change-password', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
