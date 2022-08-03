<?php

namespace App\Jobs;

use App\Helpers\Helpers;
use App\Service\Api\FeedbackService;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationNewFeedback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushNotificationTokenTrait;

    private $user;
    private $feedback;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($feedback, $user)
    {
        $this->feedback = $feedback;
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
            'title' => __('api::message.user.new_feedback'),
            'body' => $this->feedback->title,
            'badge' => $this->user->badge
        ];
        $data = [
            'title' => __('api::message.user.new_feedback'),
            'name' => $this->feedback->title,
            'detail' => $this->feedback->detail,
            'thumbnail_url' => Helpers::getUrlImg($this->feedback->thumbnail_url),
            'date' => date('Y-m-d H:i:s'),
            'type' => 'feedback',
            'device_type' => $this->user->device,
        ];
        $this->pushMessage($this->user->token, $notification, $data);
    }
}
