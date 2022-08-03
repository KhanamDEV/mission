<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 11:54 AM
 **/


namespace App\Repository\Admin\Brand;


interface BrandRepositoryInterface
{
    public function create($_data);

    public function findById($_id);

    public function updateByEmail($_email, $_data);

    public function activeByVerificationCode($_verification_code);

    public function checkHasVerificationCode($_verification_code);

    public function deleteByVerificationCode($_verification_code);

    public function checkHasAccount($_email);
}