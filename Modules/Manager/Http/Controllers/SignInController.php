<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Manager\Auth\SignInService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\SignInRequest;

class SignInController extends Controller
{

    private $signInService;

    public function __construct(SignInService $signInService)
    {
        $this->signInService = $signInService;
    }

    public function signIn()
    {
        try {
            if (Auth::guard('manager')->check()) return redirect()->route('manager.brand_index');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::auth.login', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function postSignIn(SignInRequest $request)
    {
        try {
            $data = $request->only('email', 'password');
            if ($this->signInService->signIn($data)){
                return redirect()->route('manager.brand_index');
            }
            $errors = new MessageBag(['signInFailed' => __('message.login.false')]);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function signOut()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('manager.sign_in');
    }
}
