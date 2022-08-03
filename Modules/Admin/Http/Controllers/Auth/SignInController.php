<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\Admin\Auth\AdminSignInService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Modules\Admin\Http\Requests\SignInRequest;

class SignInController extends Controller
{
    private $adminSignInService;

    public function __construct(AdminSignInService $adminSignInService)
    {
        $this->adminSignInService = $adminSignInService;
    }

    /**
     * Sign in admin
     * @method GET
     */
    public function signIn(){
        try {
            if (Auth::guard('admin')->check()) return redirect()->route('admin.user_index');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.sign_in', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function postSignIn(SignInRequest $request){
        try {
            $data = $request->only('email', 'password');
            if($this->adminSignInService->signIn($data)){
                return redirect()->route('admin.user_index');
            }
            $errors = new MessageBag(['loginFailed' => __('message.login.false') ]);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function signOut(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.sign_in');
    }
}
