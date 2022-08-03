<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\Admin\Auth\AdminSignUpService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Admin\Http\Requests\SignUpAdminRequest;

class SignUpController extends Controller
{
    private $adminSignUpService;

    public function __construct(AdminSignUpService $adminSignUpService)
    {
        $this->adminSignUpService = $adminSignUpService;
    }

    /**
     * Sign up Admin
     * @method GET
     */
    public function signUp()
    {
        try {
            if (Auth::guard('admin')->check()) Auth::guard('admin')->logout();
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.register.sign_up', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Sign up Admin
     * @method POST
     */
    public function postSignUp(SignUpAdminRequest $request){
        try {
            $data = $request->all();
            if($this->adminSignUpService->signUp($data)){
                session()->put('confirm', true);
                return redirect()->route('admin.sign_up_confirm_success');
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
            return view('admin::auth.register.confirm', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function confirmSuccess(){
        try {
            if (!session()->has('confirm')) abort(404);
            session()->forget('confirm');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.register.confirm_success', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
