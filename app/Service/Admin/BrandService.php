<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 12/05/2021
 * Time: 10:56 AM
 **/


namespace App\Service\Admin;


use App\Mail\SignUpAdminMail;
use App\Repository\Admin\Brand\BrandRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class BrandService
{
    private $blandRepository;

    public function __construct(BrandRepositoryInterface $blandRepository)
    {
        $this->blandRepository = $blandRepository;
    }

}