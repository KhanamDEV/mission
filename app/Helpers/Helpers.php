<?php
/**
 * Created by cuongnd
 */

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Helpers
{
    public static function pre($data = array())
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public static function formatDate($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('Y/m/d H:i', (strtotime($date) + $plusTime));
        } else {
            return date('Y/m/d H:i', (strtotime($date) + $plusTime));
        }
    }

    public static function getUserID($guard)
    {
        return Auth::guard($guard)->id();
    }

    public static function getDataUser($guard)
    {
        return Auth::guard($guard)->user();
    }

    public static function getUserEmail($guard)
    {
        return Auth::guard($guard)->user()->email;
    }

    public static function titleAction($data)
    {
        return array(
            'title' => !empty($data[0]) ? $data[0] : '',
            'flag' => !empty($data[1]) ? $data[1] : ''
        );
    }

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
            if ($file->getSize() > $max_size) return ResponseHelpers::serverErrorResponse([], '', __('message.response.max_size'));
//            if ((substr($folder, 0, 1) != '/') && !empty($folder)) $folder = '/' . $folder;
            $ex_file = explode('.', $file->getClientOriginalName());
            $extent = strtolower($ex_file[(count($ex_file) - 1)]);
            if (in_array($extent, $arrType)) {
                $uploadDir = $bucket . $folder . "/" . strtotime(date('Y-m-d H:i:s')).".$extent";
                $upload = Storage::disk('s3')->put($uploadDir, file_get_contents($file), 'public');
                if ($upload) {
                    return ResponseHelpers::showResponse($uploadDir, '', __('message.response.success'));
                } else {
                    return ResponseHelpers::serverErrorResponse([], '', __('message.response.resource_not_found'));
                }
            } else {
                return ResponseHelpers::serverErrorResponse([], '', __('message.response.resource_not_found'));
            }
        } catch (\Exception $ex) {
            return ResponseHelpers::serverErrorResponse([], '', $ex->getMessage());
        }
    }

    public static function formatDateTime($date, $format)
    {
        return date($format, strtotime($date));
    }

    public static function getUrlImg($path)
    {
        return env('AWS_URL') . $path;
    }

    public static function generateTokenResetPassword()
    {
        return bin2hex(random_bytes(3));
    }

    public static function validateEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function formatDateImportFile($date){
        return preg_replace("/(\/)/","-", $date);
    }

    public static function getParamRequest($param){
        return request()->has($param) ? request()->get($param) : '';
    }

    public static function renderTypeQuestion($type = ''){
        $arr_type = [
            1 => 'チェックリスト',
            2 => 'ラジオボタン',
            3 => 'テキスト',
            4 => '画像'
        ]   ;
        return empty($type) ? $arr_type : $arr_type[$type];
    }

    public static function renderDestinationNotification($type = ''){
        $destination = [
           'all' => '全員',
           'team' => 'チーム',
            'user' => '個人'
        ];
        return empty($type) ? $destination : $destination[$type];
    }

    public static function paginate($items, $perPage = 10, $page = null,
                             $baseUrl = null,
                             $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ?
            $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage),
            $items->count(),
            $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }

    public static function statusAnonymous($status = ''){
        $arrStatus = [
            0 => '実名',
            1 => '匿名'
        ];
        return !array_key_exists($status, $arrStatus) ? $arrStatus : $arrStatus[$status];
    }

    public static function validateUser($user){
        if (!filter_var($user->mailaddress, FILTER_VALIDATE_EMAIL)) return false;
        if (strlen($user->password) < 8) return false;
        $pattern_kana = '/^[ア-ン゛゜ァ-ォャ-ョー ]+$/u';
        if (!preg_match($pattern_kana, $user->sei_kana) || !preg_match($pattern_kana, $user->mei_kana)) return false;
        if (!in_array(strtolower($user->gender), ['man', 'woman'])) return false;
        if (!in_array(strtolower($user->is_active), ['true', 'false']) || !in_array(strtolower($user->is_admin), ['true', 'false'])) return  false;
        return true;
    }
}
