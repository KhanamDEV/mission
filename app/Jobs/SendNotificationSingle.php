<?php

namespace App\Jobs;

use App\Helpers\ResponseHelpers;
use App\Service\Firebase\PushNotificationTokenTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationSingle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, PushNotificationTokenTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $tokens;
    private $notification;
    private $data;

    public function __construct($tokens, $notification, $data)
    {
        $this->tokens = $tokens;
        $this->notification = $notification;
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
            foreach ($this->tokens as $item){
                $this->data['device_type'] = $item->device;
                $this->pushMessage($item->token, $this->notification, $this->data);
            }
        } catch (\Exception $e){
            ResponseHelpers::messageSlack(['position' => 'notification single' , 'message' => $e->getMessage()]);
        }

    }
}
