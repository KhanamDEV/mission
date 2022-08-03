<?php

namespace App\Service\Api;

use App\Helpers\Helpers;
use App\Helpers\ImageHelper;


class ApiUploadService
{

    public function uploadImage($fileString, $type)
    {
        $user = auth()->guard('api')->user();
        switch ($type) {
            case 'avatar':
                $image = ImageHelper::storeBase64Img($fileString, 'user/images');
                return is_array($image) ? $image : Helpers::getUrlImg($image);
            case 'team':
                $image = ImageHelper::storeBase64Img($fileString, 'team/images');
                return is_array($image) ? $image : Helpers::getUrlImg($image);
            case 'question':
                $image = ImageHelper::storeBase64Img($fileString, 'question/images');
                return is_array($image) ? $image : Helpers::getUrlImg($image);
            default:
                return false;
        }


    }

}