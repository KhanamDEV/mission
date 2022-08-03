<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationCommon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushNotificationTokenTrait;

    private $user;
    private $data;
    private $objToken;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $objToken, $user)
    {
        $this->data = $data;
        $this->user = $user;
        $this->objToken = $objToken;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->user->name_sei.$this->user->name_mei;
        $notification = [
            'title' => $name.__('api::message.user.seen_notification_beer'),
            'badge' => $this->objToken->badge
        ];
        $data = [
            'title' => $name.__('api::message.user.seen_notification_beer'),
            'thumbnail_url' => asset('static/user/images/logo.png'),
            'date' => date('Y-m-d H:i:s'),
            'type' => $this->data['type'],
            'device_type' => $this->objToken->device,
        ];
        $this->pushMessage($this->objToken->token, $notification, $data);
    }
}
