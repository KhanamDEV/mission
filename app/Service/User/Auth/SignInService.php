<?php
/**
 * Created by PhpStorm.
 * User: Kha Nam Tech Asia
 * Date: 02/06/2021
 * Time: 09:19
 */

namespace App\Service\User\Auth;


use App\Repository\User\UserLogin\UserLoginRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SignInService
{
    private $userLoginRepository;

    public function __construct(UserLoginRepositoryInterface $userLoginRepository)
    {
        $this->userLoginRepository = $userLoginRepository;
    }

    public function signIn($data)
    {
        $status = Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password']]);
        if($status){
            $dataLogin = [
                'user_id' => Auth::guard('user')->user()->id,
                'device' => 'web',
                'logined_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            if (!$this->userLoginRepository->store($dataLogin)) {
                Auth::guard('user')->logout();
                return false;
            } else{
                return true;
            }
        }
        return $status;
    }
}