<?php

namespace App\Repository\User;

interface UserRepositoryInterface
{
    public function create($_data);

    public function updateByEmail($_email, $_data);

    public function activeByVerificationCode($_verification_code);

    public function checkHasVerificationCode($_verification_code);

    public function deleteByVerificationCode($_verification_code);

    public function checkHasAccount($_email);

    public function truncate();

    public function getListByBrandId($_brand_id, $_per_page);

    public function findById($_id);

    public function update($_id, $_data);

    public function checkHasUserByEmail($_email);

    public function findByEmail($_email);

    public function delete($_id);
}