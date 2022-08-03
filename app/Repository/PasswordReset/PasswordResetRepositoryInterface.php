<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 19/05/2021
 * Time: 9:43 AM
 **/


namespace App\Repository\PasswordReset;


interface PasswordResetRepositoryInterface
{
    public function create($_data);

    public function getByTokenValid($_data);

    public function changeStatusByToken($_token);

    public function getEmailNotConfirm($_email, $_type);
}