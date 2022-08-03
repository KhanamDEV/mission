<?php

namespace Modules\Api\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Service\Api\ApiFunctionService;
use App\Service\Api\UserLoginService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class SignInController extends Controller
{
    private $apiFunctionService;
    private $userLoginService;

    public function __construct(ApiFunctionService $apiFunctionService, UserLoginService $userLoginService)
    {
        $this->apiFunctionService = $apiFunctionService;
        $this->userLoginService = $userLoginService;
    }

    /**
     * @group SignIn
     * api/v2/sign-in
     * @bodyParam email string required The email of brand account
     * @bodyParam password string required The password of brand account
     *
     * @response 200{
     *      "meta": {
     *          "status": 200,
     *          "message": "保存しました"
     *      },
     *      "response": {
     *          "id": 1,
     *          "email": "khanam@techasia.biz",
     *          "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvc2lnbi1pbiIsImlhdCI6MTYyMTU2OTA2NiwiZXhwIjoxNjIxNTcyNjY2LCJuYmYiOjE2MjE1NjkwNjYsImp0aSI6IjEyZEVkdGdFTnUweHZnd24iLCJzdWIiOjEsInBydiI6IjIzOWNmMmI3ZDU4MjI2ZTgyMWMxMjQxMDAyMzBkZWU5ZmE4ZWQ2NzkifQ.b0R2TRZxGyBq9JUMCjgt-fjFieNEd5Ywo1jD9u_WPZA"
     *      }
     * }
     *
     * @response 401{
     *      "meta": {
     *          "status": 401,
     *          "message": "メールアドレスとパスワードが不一致"
     *      },
     *      "response": null
     * }
     *
     */
    public function postSignIn(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return ResponseHelpers::authenticateErrorResponse(__('api::message.login.login_false'));
            }
            $user = Auth::user();
            if (!$user->is_active){
                return ResponseHelpers::authenticateErrorResponse(__('api::message.login.account_not_active'));
            }
            $user->access_token = $token;
            if (!$this->userLoginService->store()) return ResponseHelpers::serverErrorResponse();
            return ResponseHelpers::showResponse($this->apiFunctionService->formatUser($user));
        } catch (JWTException $e) {
            ResponseHelpers::messageSlack(['position' => 'login', 'message' => $e->getMessage()]);
            return ResponseHelpers::serverErrorResponse();
        }
    }
}
