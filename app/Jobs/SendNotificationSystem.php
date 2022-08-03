<?php

namespace App\Jobs;

use App\Helpers\ResponseHelpers;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationSystem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushNotificationTokenTrait;

    private $users;
    private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $data)
    {
        $this->users = $users;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            foreach ($this->users as $user){
                if (!is_null($user->push_notification_token)){
                        $notification = [
                            'title' => $this->data['title'],
                            'body' => $this->data['description'],
                            'badge' => $user->badge
                        ];
                        $data = [
                            'title' => $this->data['title'],
                            'thumbnail_url' => asset('static/user/images/logo.png'),
                            'detail' => $this->data['description'],
                            'date' => date('Y-m-d H:i:s'),
                        ];
                        $notificationSingle = new SendNotificationSingle(@json_decode($user->push_notification_token), $notification, $data);
                        dispatch($notificationSingle)->delay(now()->addSeconds(2));
                }
            }
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'notification system' , 'message' => $e->getMessage()]);
        }
    }
}
