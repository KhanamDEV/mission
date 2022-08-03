<?php

namespace App\Service\Firebase;

use App\Helpers\ResponseHelpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FCMService
{
    private $apiConfig;
    private $deviceType;
    private $sound;

    public function __construct()
    {
        $this->deviceType = [
            'ios' => 'iOS',
            'android' => 'android'
        ];
        $this->sound = 'default';
        $this->apiConfig = [
            'url' => env('FIREBASE_URL'),
            'server_key' => env('FIREBASE_SERVER_KEY'),
            'device_type' => $this->deviceType
        ];
    }



    public function sendPushNotification($filed){
        try {
            $client = new Client([
               'headers' => [
                   'Content-Type' => 'application/json',
                   'Authorization' => 'key='. $this->apiConfig['server_key'],
               ]
            ]);
            $res = $client->post(
                $this->apiConfig['url'],
                ['body' => json_encode($filed)]
            );
            if ($res->getStatusCode() != ResponseAlias::HTTP_OK) return  false;
            return true;
        } catch (Exception | GuzzleException $e){
            ResponseHelpers::messageSlack($e->getMessage());
            return  false;
        }
    }

    /**
     * @param string $deviceToken
     * @param array $notification
     * @param array $data
     */
    public function send($deviceToken, $notification, $data){
        try {
//            if ($data['device_type'] == $this->deviceType['ios']){
//                $fields = [
//                    'to' => $deviceToken,
//                    'notification' => $notification,
//                    'data' => $data
//                ];
//            } else{
//                $fields = [
//                    'to' => $deviceToken,
//                    'data' => array_merge($notification, $data)
//                ];
//            }
            $fields = [
                'to' => $deviceToken,
                'notification' => $notification,
                'data' => $data
            ];
            return $this->sendPushNotification($fields);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack($e->getMessage());
            return  false;
        }
    }

    /**
     * @param array $deviceToken
     * @param array $notification
     * @param array $data
     */
    public function sendMultiType($deviceToken, $notification, $data){
        try {
            $fields = [
                'registration_ids' => $deviceToken,
                'data' => $data,
                'notification' => $notification
            ];
            return $this->sendPushNotification($fields);
        } catch (\Exception $e){
            ResponseHelpers::messageSlack($e->getMessage());
            return  false;
        }
    }
}