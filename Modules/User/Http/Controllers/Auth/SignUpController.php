<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\User\Auth\SignUpService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\User\Http\Requests\SignUpUserRequest;

class SignUpController extends Controller
{
    private $userSignUpService;
    
    public function __construct(SignUpService $userSignUpService)
    {
        $this->userSignUpService = $userSignUpService;
    }

    /**
     * Sign up user
     * @method GET
     */
    public function signUp()
    {
        try {
            if (Auth::guard('user')->check()) Auth::guard('user')->logout();
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('user::auth.register.sign_up', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Sign up user
     * @method POST
     */
    public function postSignUp(SignUpUserRequest $request){
        try {
            $data = $request->all();
            $token = $this->userSignUpService->signUp($data);
            if ($token){
                session()->put('token', $token);
                return redirect()->route('user.sign_up_confirm');
            }
            $errors = new MessageBag(['error_sign_up' => __('message.alert.has_error')]);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function confirm(){
        try {
            if (!session()->has('token')) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('user::auth.register.confirm', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function confirmSuccess($token){
        try {
            if ($this->userSignUpService->checkHasVerificationCode($token)) abort('404');
            if (!$this->userSignUpService->activeByVerificationCode($token)) abort('404');
            session()->forget('token');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('user::auth.register.confirm_success', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
