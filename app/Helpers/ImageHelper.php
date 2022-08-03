<?php


namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function upLoadFile($file = null, $folder = null, $type = 'img')
    {
        try {
            $arrType = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            if ($type == 'data_user') {
                $arrType = ['csv', 'xlsx'];
                $folder = $folder . "/" . date('Y/m/d/H/i/s');
            }
            $max_size = !empty(env('AWS_SIZE')) ? env('AWS_SIZE') : 5242880;
            $bucket = '';
            if (empty($file->getClientOriginalName()) || empty($file->getSize())) return '';
            if ($file->getSize() > $max_size) return false;
            $ex_file = explode('.', $file->getClientOriginalName());
            $extent = strtolower($ex_file[(count($ex_file) - 1)]);
            unset($ex_file[(count($ex_file) - 1)]);
            if (in_array($extent, $arrType)) {
                $fileNameNoSpace = strtotime(date('Y-m-d H:i:s'));
                $uploadDir = $bucket . $folder."/".$fileNameNoSpace;
                $upload = Storage::disk('s3')->put($uploadDir, file_get_contents($file), 'public');
                if ($upload) {
                    return $fileNameNoSpace;
                }
                else{
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function storeBase64Img($image_64, $folder)
    {
        try {
            $bucket = '';
            $max_size = !empty(env('AWS_SIZE')) ? env('AWS_SIZE') : 5242880;
            $data = str_replace('data:image/png;base64,', '', $image_64);
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE);
            $fileType = explode('/', $mime_type);
            $fileType = $fileType[count($fileType) - 1];
            $size = (int) (strlen(rtrim($image_64, '=')) * 3 / 4);
            if ($size > $max_size) {
                return ['status' => false, 'message' => __('api::message.upload.image_max_size')];
            }
            if (in_array($fileType, ['jpg', 'jpeg', 'png'])) {
                $uploadDir = "$bucket$folder/". strtotime(date('Y-m-d H:i:s')) .  ".$fileType";
                return Storage::disk('s3')->put($uploadDir, $data, 'public') ? $uploadDir : false;
            } else {
                return ['status' => false, 'message' => __('api::message.upload.image_failed_type')];
            }
        } catch (\Exception $e){
            ResponseHelpers::messageSlack($e->getMessage());
            return ['status' => false, 'message' => __('api::response.an_error_has_occurred')];
        }

    }
}