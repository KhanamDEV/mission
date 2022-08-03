<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use App\Service\Api\MissionService;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationNewMissionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushNotificationTokenTrait;

    private $mission;
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mission, $user)
    {
        $this->mission = $mission;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notification = [
            'title' => __('api::message.user.new_mission'),
            'body' => $this->mission->name,
            'badge' => $this->user->badge
        ];
        $data = [
            'title' => __('api::message.user.new_mission'),
            'name' => $this->mission->name,
            'detail' => $this->mission->detail,
            'thumbnail_url' => Helpers::getUrlImg($this->mission->thumbnail_url),
            'date' => date('Y-m-d H:i:s'),
            'type' => 'mission',
            'device_type' => $this->user->device,
        ];
        $this->pushMessage($this->user->token, $notification, $data);
    }
}
