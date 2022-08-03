<?php
/**
 * Created by PhpStorm
 * User: Kha Nam
 * Date: 22/11/2021
 * Time: 14:38
 */

namespace App\Service\Admin;

use App\Repository\Admin\Brand\BrandRepositoryInterface;
use App\Repository\Admin\SystemNotify\SystemNotificationRepositoryInterface;
use App\Repository\Admin\Team\TeamMemberRepositoryInterface;
use App\Repository\Admin\Team\TeamRepository;
use App\Repository\Admin\Team\TeamRepositoryInterface;
use App\Repository\Admin\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;


class SystemNotifyService
{
    private $systemNotificationRepository;
    private $teamMemberRepository;
    private $teamRepository;
    private $brandRepository;
    private $userRepository;

    public function __construct(SystemNotificationRepositoryInterface $systemNotificationRepository,
                                TeamMemberRepositoryInterface $teamMemberRepository, TeamRepositoryInterface $teamRepository,
                                BrandRepositoryInterface $brandRepository, UserRepositoryInterface $userRepository)
    {
        $this->systemNotificationRepository = $systemNotificationRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->teamRepository = $teamRepository;
        $this->brandRepository = $brandRepository;
        $this->userRepository = $userRepository;
    }

    public function findById($id){
        $notify = $this->systemNotificationRepository->findById($id);
        if (!is_null($notify->option)){
            $option = @json_decode($notify->option);
            if (isset($option->team_id)) $option->team = $this->teamRepository->findById($option->team_id);
            if (isset($option->brand_id)) $option->brand = $this->brandRepository->findById($option->brand_id);
            if (isset($option->user_id)) $option->user = $this->userRepository->findById($option->user_id);
            $notify->option = $option;
        }
        return $notify;
    }

    public function getListByUserId($userId, $limit = null){
        $brandId = Auth::guard('admin')->user()->id;
        $teamOfUser = $this->teamMemberRepository->getListByUser($userId)->pluck('team_id')->toArray();
        $notifies = $this->systemNotificationRepository->getList([]);
        $notifyOfUser = [];
        foreach ($notifies as $notify){
            if ($notify->type == 'all') array_push($notifyOfUser, $notify);
            if ($notify->type == 'user'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $brandId){
                    if ($option->user_id == $userId) array_push($notifyOfUser, $notify);
                }
            }
            if ($notify->type == 'team'){
                $option = @json_decode($notify->option);
                if ($option->brand_id == $brandId){
                    if (in_array((int) $option->team_id, $teamOfUser)) array_push($notifyOfUser, $notify);
                }
            }
        }
        return is_null($limit) ? $notifyOfUser : collect($notifyOfUser)->take($limit);
    }

    public function getList(){
        return $this->systemNotificationRepository->getList(['perPage' => 10]);
    }
}