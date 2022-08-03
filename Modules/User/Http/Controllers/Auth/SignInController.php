<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\User\Auth\SignInService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\User\Http\Requests\SignInRequest;

class SignInController extends Controller
{

    private $signInService;

    public function __construct(SignInService $signInService)
    {
        $this->signInService = $signInService;
    }

    public function signIn(){
        try {
            if (Auth::guard('user')->check()) return redirect()->route('user.index');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('user::auth.sign_in', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function postSignIn(SignInRequest $request){
        try {
            $data = $request->only('email', 'password');
            if ($this->signInService->signIn($data)){
                if (!Auth::guard('user')->user()->is_active){
                    $errors = new MessageBag(['sign_in_false' =>  __('message.login.account_not_active') ]);
                    Auth::guard('user')->logout();
                    return redirect()->back()->withInput($data)->withErrors($errors);
                }
                return redirect()->route('user.index');
            }
            $errors = new MessageBag(['sign_in_false' =>  __('message.login.false') ]);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function signOut(){
        try {
            Auth::guard('user')->logout();
            return redirect()->route('user.sign_in');
        } catch (\Exception $e){
            abort('500');
        }
    }
}
