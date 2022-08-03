<?php

namespace App\Service\Firebase;

trait PushNotificationTokenTrait
{
    /**
     * @param string $deviceToken
     * @param array $notification
     * @param array $data
     * @return bool
     */
    public function pushMessage($deviceToken, $notification, $data){
        $pushNotificationService = new FCMService();
       return $pushNotificationService->send($deviceToken, $notification, $data);
    }

    /**
     * @param array $deviceToken
     * @param array $notification
     * @param array $data
     */
    public function pushMessages($deviceToken, $notification, $data){
        $pushNotificationService = new FCMService();
        return $pushNotificationService->sendMultiType($deviceToken, $notification, $data);
    }
}