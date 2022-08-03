<?php

namespace App\Console\Commands;

use App\Helpers\ResponseHelpers;
use App\Jobs\SendNotificationNewFeedback;
use App\Jobs\SendNotificationNewMissionJob;
use App\Service\Api\FeedbackService;
use App\Service\Api\MissionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendNotificationSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendNotificationSchedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(MissionService $missionService)
    {
        DB::beginTransaction();
        try {
            $missions = $missionService->getMissionDaily();
            foreach ($missions as $mission){
                if (!DB::table('users')->where('id', $mission->user_id)->update(['number_notification' => DB::raw('number_notification + 1'), 'updated_at' => date('Y-m-d H:i:s')])){
                    DB::rollBack();
                    return false;
                }
                foreach ($mission->user_push_notification as $user){
                    $user->badge = DB::table('users')->where('id', $mission->user_id)->first()->number_notification;
                    $jobSendNotificationMission = new SendNotificationNewMissionJob($mission, $user);
                    dispatch($jobSendNotificationMission)->delay(now()->addSeconds(10));
                }
            }
            DB::commit();
            ResponseHelpers::messageSlack(['message' => 'Send mission daily' ,'time' => date('Y-m-d H:i:s')]);
        } catch (\Exception $e){
            DB::rollBack();
            ResponseHelpers::messageSlack(['position' => 'mission daily', 'message' => $e->getMessage()]);
            return false;
        }

    }
}
