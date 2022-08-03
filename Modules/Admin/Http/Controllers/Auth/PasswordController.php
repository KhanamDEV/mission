<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\Admin\Auth\PasswordService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Admin\Http\Requests\ConfirmMailForgetPasswordRequest;
use Modules\Admin\Http\Requests\ForgetPasswordRequest;

class PasswordController extends Controller
{

    private $passwordService;

    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }

    /**
     * Confirm mail forget password
     * @method GET
     */
    public function confirmMail()
    {
        try {
            if (Auth::guard('admin')->check()) Auth::guard('admin')->logout();
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.password.confirm_mail', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Confirm mail forget password
     * @method POST
     */
    public function postConfirmMail(ConfirmMailForgetPasswordRequest $request)
    {
        try {
            $data = $request->only('email');
            if (empty($this->passwordService->findByEmail($data['email']))) {
                $errors = new MessageBag(['hasError' => __('message.mail.not_register')]);
                return redirect()->back()->withErrors($errors)->withInput($data);
            }
            $token = $this->passwordService->sendConfirmMail($data);
            if ($token) {
                session()->put('token_forget', $token);
                return redirect()->route('admin.forget_password_confirm');
            }
            $errors = new MessageBag(['hasError' => __('message.alert.has_error')]);
            return redirect()->back()->withErrors($errors)->withInput($data);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Notify send mail success
     * @method GET
     */
    public function confirm()
    {
        try {
            if (!session()->has('token_forget')) abort('404');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.password.confirm', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Change password
     * @method GET
     */
    public function change($token)
    {
        try {
            $dataPassword = $this->passwordService->getByTokenValid($token);
            if (empty($dataPassword)) abort('404');
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('admin::auth.password.change', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Change password
     * @method POST
     */
    public function postChange(ForgetPasswordRequest $request, $token)
    {
        try {
            $data = $request->all();
            $data['token'] = $token;
            if ($this->passwordService->changePassword($data)) {
                return redirect()->route('admin.sign_in');
            }
            $errors = new MessageBag(['hasError' => __('message.alert.has_error')]);
            return redirect()->back()->withErrors($errors);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
