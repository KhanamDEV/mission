<?php

namespace App\Console\Commands;

use App\Repository\Admin\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Admin\Team\TeamMemberRepositoryInterface;
use App\Repository\Manager\SystemNotify\SystemNotifyRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetNumberNotificationUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SetNumberNotificationUser';

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

    private $teamMemberRepository;
    private $brandNotifyRepository;
    private $systemNotifyRepository;

    public function __construct(TeamMemberRepositoryInterface $teamMemberRepository, BrandNotifyRepositoryInterface $brandNotifyRepository, SystemNotifyRepositoryInterface $systemNotifyRepository)
    {
        parent::__construct();
        $this->teamMemberRepository = $teamMemberRepository;
        $this->brandNotifyRepository = $brandNotifyRepository;
        $this->systemNotifyRepository = $systemNotifyRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $users = DB::table('users')->get();
            foreach ($users as $user){
                $numberNotificationMission = count(DB::table('missions')->where('user_id', $user->id)->whereNull('user_look_at')->get());
                $numberNotificationFeedback = count(DB::table('feedbacks')->where('user_id', $user->id)->whereNull('user_look_at')->get());
                $notifyOfUser = $numberNotificationMission + $numberNotificationFeedback;
                $teamOfUser = $this->teamMemberRepository->getListByUser($user->id)->pluck('team_id')->toArray();
                $notifiesBrand = $this->brandNotifyRepository->getList(['brand_id' => $user->brand_id]);
                $notifiesSystem = $this->systemNotifyRepository->getList([]);
                foreach ($notifiesBrand as $notify){
                    $notify->seen_users =  @json_decode($notify->seen_users);
                    if ($notify->type == 'all' && !in_array($user->id, $notify->seen_users ?? [])) $notifyOfUser++;
                    if ($notify->type == 'user' && !in_array($user->id, $notify->seen_users ?? [])){
                        $option = @json_decode($notify->option);
                        if ($option->user_id == $user->id) $notifyOfUser++;
                    }
                    if ($notify->type == 'team' && !in_array($user->id, $notify->seen_users ?? [])){
                        $option = @json_decode($notify->option);
                        if (in_array((int) $option->team_id, $teamOfUser)) $notifyOfUser++;
                    }
                }
                foreach ($notifiesSystem as $notify){
                    $notify->seen_users = @json_decode($notify->seen_users);
                    if ($notify->type == 'all' && !in_array($user->id, $notify->seen_users ?? [])) $notifyOfUser++;
                    if ($notify->type == 'user' && !in_array($user->id, $notify->seen_users ?? [])){
                        $option = @json_decode($notify->option);
                        if ($option->brand_id == $user->brand_id ){
                            if ($option->user_id == $user->id) $notifyOfUser++;
                        }
                    }
                    if ($notify->type == 'team' && !in_array($user->id,$notify->seen_users ?? [])){
                        $option = @json_decode($notify->option);
                        if ($option->brand_id == $user->brand_id){
                            if (in_array((int) $option->team_id, $teamOfUser)) $notifyOfUser++;
                        }
                    }
                }
                if (!DB::table('users')->where('id', $user->id)->update(['number_notification' => $notifyOfUser, 'updated_at' => date('Y-m-d H:i:s')])){
                    DB::rollBack();
                    return  false;
                }
            }
            DB::commit();
            $this->info('Success');
        } catch (\Exception $e){
            DB::rollBack();
            $this->info($e->getMessage());
        }

    }
}
