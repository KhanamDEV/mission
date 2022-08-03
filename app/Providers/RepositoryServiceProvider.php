<?php


namespace App\Providers;


use App\Repository\Admin\Brand\BrandRepository;
use App\Repository\Admin\Brand\BrandRepositoryInterface;
use App\Repository\Admin\LoginHistory\LoginHistoryRepository;
use App\Repository\Admin\LoginHistory\LoginHistoryRepositoryInterface;
use App\Repository\Admin\LogUpdateUser\LogUpdateUserRepository;
use App\Repository\Admin\LogUpdateUser\LogUpdateUserRepositoryInterface;
use App\Repository\Admin\Mission\MissionRepository;
use App\Repository\Admin\Mission\MissionRepositoryInterface;
use App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerRepository;
use App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Admin\Program\ProgramHistoryRepository;
use App\Repository\Admin\Program\ProgramHistoryRepositoryInterface;
use App\Repository\Admin\Team\TeamMemberRepository;
use App\Repository\Admin\Team\TeamMemberRepositoryInterface;
use App\Repository\Admin\Team\TeamRepository;
use App\Repository\Admin\Team\TeamRepositoryInterface;
use App\Repository\Api\Feedback\FeedbackBaseBaseRepository;
use App\Repository\Api\Feedback\FeedbackBaseRepository;
use App\Repository\Api\Feedback\FeedbackBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionBaseRepository;
use App\Repository\Api\Mission\MissionBaseRepositoryInterface;
use App\Repository\Api\Mission\MissionQuestionAnswerBaseRepository;
use App\Repository\Api\Mission\MissionQuestionAnswerBaseRepositoryInterface;
use App\Repository\Api\MissionQuestion\MissionQuestionRepository;
use App\Repository\Api\MissionQuestion\MissionQuestionRepositoryInterface;
use App\Repository\Api\Notification\BrandNotificationRepository;
use App\Repository\Api\Notification\BrandNotificationRepositoryInterface;
use App\Repository\Api\Notification\SystemNotificationRepository;
use App\Repository\Api\Notification\SystemNotificationRepositoryInterface;
use App\Repository\Manager\BrandNotify\BrandNotifyRepository;
use App\Repository\Manager\BrandNotify\BrandNotifyRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackRepository;
use App\Repository\Manager\Feedback\FeedbackRepositoryInterface;
use App\Repository\Manager\Program\ProgramMissionRepository;
use App\Repository\Manager\Program\ProgramMissionRepositoryInterface;
use App\Repository\Manager\SystemNotify\SystemNotifyRepository;
use App\Repository\Manager\SystemNotify\SystemNotifyRepositoryInterface;
use App\Repository\PasswordReset\PasswordResetRepository;
use App\Repository\PasswordReset\PasswordResetRepositoryInterface;
use App\Repository\User\UserLogin\UserLoginRepository;
use App\Repository\User\UserLogin\UserLoginRepositoryInterface;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryInterface;
use App\Repository\Admin\Program\ProgramRepository;
use App\Repository\Admin\Program\ProgramRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\Admin\User\UserRepositoryInterface as UserInterfaceInAdmin;
use App\Repository\Admin\User\UserRepository as UserInAdmin;

//manager
use App\Repository\Manager\Brand\BrandRepositoryInterface as BrandRepositoryInterfaceInManager;
use App\Repository\Manager\Brand\BrandRepository as BrandRepositoryInManager;
use App\Repository\Manager\User\UserRepositoryInterface as UserRepositoryInterfaceInManager;
use App\Repository\Manager\User\UserRepository as UserRepositoryInManager;
use App\Repository\Manager\LogUpdateUser\LogUpdateUserRepositoryInterface as LogUpdateUserRepositoryInterfaceInManager;
use App\Repository\Manager\LogUpdateUser\LogUpdateUserRepository as LogUpdateUserRepositoryInManager;
use App\Repository\Manager\Team\TeamRepositoryInterface as TeamRepositoryInterfaceInManager;
use App\Repository\Manager\Team\TeamRepository as TeamRepositoryInManager;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface as TeamMemberRepositoryInterfaceInManager;
use App\Repository\Manager\TeamMember\TeamMemberRepository as TeamMemberRepositoryInManager;
use App\Repository\Manager\LoginHistory\LoginHistoryRepository as LoginHistoryManagerRepository;
use App\Repository\Manager\LoginHistory\LoginHistoryRepositoryInterface as LoginHistoryManagerRepositoryInterface;

use App\Repository\Manager\Mission\MissionBaseRepository as ManagerMissionBaseRepository;
use App\Repository\Manager\Mission\MissionBaseRepositoryInterface as ManagerMissionBaseRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackBaseRepository as ManagerFeedbackBaseRepository;
use App\Repository\Manager\Feedback\FeedbackBaseRepositoryInterface as ManagerFeedbackBaseRepositoryInterface;
use App\Repository\Manager\Question\QuestionBaseRepository as ManagerQuestionBaseRepository;
use App\Repository\Manager\Question\QuestionBaseRepositoryInterface as ManagerQuestionBaseRepositoryInterface;
use App\Repository\Manager\Program\ProgramRepositoryInterface as ProgramRepositoryInterfaceInManager;
use App\Repository\Manager\Program\ProgramRepository as ProgramRepositoryInManager;
use App\Repository\Manager\Mission\MissionRepositoryInterface as MissionRepositoryInterfaceInManager;
use App\Repository\Manager\Mission\MissionRepository as MissionRepositoryInManager;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //user
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(\App\Repository\User\Mission\MissionRepositoryInterface::class, \App\Repository\User\Mission\MissionRepository::class);
        $this->app->bind(\App\Repository\User\Team\TeamRepositoryInterface::class, \App\Repository\User\Team\TeamRepository::class);
        $this->app->bind(\App\Repository\User\TeamMember\TeamMemberRepositoryInterface::class, \App\Repository\User\TeamMember\TeamMemberRepository::class);
        $this->app->bind(\App\Repository\User\Program\ProgramRepositoryInterface::class, \App\Repository\User\Program\ProgramRepository::class);
        $this->app->bind(\App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface::class, \App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerRepository::class);
        $this->app->bind(\App\Repository\User\ProgramHistory\ProgramHistoryRepositoryInterface::class, \App\Repository\User\ProgramHistory\ProgramHistoryRepository::class);
        $this->app->bind(\App\Repository\User\LogUpdateUser\LogUpdateUserRepositoryInterface::class, \App\Repository\User\LogUpdateUser\LogUpdateUserRepository::class);
        $this->app->bind(UserLoginRepositoryInterface::class, UserLoginRepository::class);
        $this->app->bind(\App\Repository\User\ProgramMission\ProgramMissionRepositoryInterface::class, \App\Repository\User\ProgramMission\ProgramMissionRepository::class);
        $this->app->bind(\App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerBaseRepositoryInterface::class, \App\Repository\User\MissionQuestionAnswer\MissionQuestionAnswerBaseRepository::class);
        $this->app->bind(\App\Repository\User\Feedback\FeedbackRepositoryInterface::class, \App\Repository\User\Feedback\FeedbackRepository::class);
        $this->app->bind(\App\Repository\User\Mission\MissionQuestionRepositoryInterface::class, \App\Repository\User\Mission\MissionQuestionRepository::class);
        $this->app->bind(\App\Repository\User\BrandNotify\BrandNotifyRepositoryInterface::class, \App\Repository\User\BrandNotify\BrandNotifyRepository::class);
        $this->app->bind(\App\Repository\User\SystemNotify\SystemNotificationRepositoryInterface::class, \App\Repository\User\SystemNotify\SystemNotificationRepository::class);
        //admin
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(MissionRepositoryInterface::class, MissionRepository::class);
        $this->app->bind(LogUpdateUserRepositoryInterface::class, LogUpdateUserRepository::class);
        $this->app->bind(TeamMemberRepositoryInterface::class, TeamMemberRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(ProgramRepositoryInterface::class, ProgramRepository::class);
        $this->app->bind(UserInterfaceInAdmin::class, UserInAdmin::class );
        $this->app->bind(ProgramHistoryRepositoryInterface::class, ProgramHistoryRepository::class);
        $this->app->bind(MissionQuestionAnswerRepositoryInterface::class, MissionQuestionAnswerRepository::class);
        $this->app->bind(\App\Repository\Admin\ProgramMission\ProgramMissionRepositoryInterface::class, \App\Repository\Admin\ProgramMission\ProgramMissionRepository::class);
        $this->app->bind(\App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerBaseRepositoryInterface::class, \App\Repository\Admin\MissionQuestionAnswer\MissionQuestionAnswerBaseRepository::class);
        $this->app->bind(\App\Repository\Admin\BrandNotify\BrandNotifyRepositoryInterface::class, \App\Repository\Admin\BrandNotify\BrandNotifyRepository::class);
        $this->app->bind(\App\Repository\Admin\SystemNotify\SystemNotificationRepositoryInterface::class, \App\Repository\Admin\SystemNotify\SystemNotificationRepository::class);
        $this->app->bind(\App\Repository\Admin\Feedback\FeedbackRepositoryInterface::class, \App\Repository\Admin\Feedback\FeedbackRepository::class);
        $this->app->bind(LoginHistoryRepositoryInterface::class, LoginHistoryRepository::class);
        $this->app->bind(\App\Repository\Admin\Mission\MissionQuestionRepositoryInterface::class, \App\Repository\Admin\Mission\MissionQuestionRepository::class);

        //manager
        $this->app->bind(ManagerMissionBaseRepositoryInterface::class, ManagerMissionBaseRepository::class);
        $this->app->bind(ManagerFeedbackBaseRepositoryInterface::class, ManagerFeedbackBaseRepository::class);
        $this->app->bind(ManagerQuestionBaseRepositoryInterface::class, ManagerQuestionBaseRepository::class);
        $this->app->bind(BrandRepositoryInterfaceInManager::class, BrandRepositoryInManager::class );
        $this->app->bind(UserRepositoryInterfaceInManager::class, UserRepositoryInManager::class);
        $this->app->bind(LogUpdateUserRepositoryInterfaceInManager::class, LogUpdateUserRepositoryInManager::class);
        $this->app->bind(TeamRepositoryInterfaceInManager::class, TeamRepositoryInManager::class);
        $this->app->bind(TeamMemberRepositoryInterfaceInManager::class, TeamMemberRepositoryInManager::class);
        $this->app->bind(ProgramRepositoryInterfaceInManager::class, ProgramRepositoryInManager::class);
        $this->app->bind(MissionRepositoryInterfaceInManager::class, MissionRepositoryInManager::class);
        $this->app->bind(ProgramMissionRepositoryInterface::class, ProgramMissionRepository::class);
        $this->app->bind(LoginHistoryManagerRepositoryInterface::class, LoginHistoryManagerRepository::class);
        $this->app->bind(\App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface::class, \App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepository::class);
        $this->app->bind(\App\Repository\Manager\Program\ProgramHistoryRepositoryInterface::class, \App\Repository\Manager\Program\ProgramHistoryRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(BrandNotifyRepositoryInterface::class, BrandNotifyRepository::class);
        $this->app->bind(SystemNotifyRepositoryInterface::class, SystemNotifyRepository::class);
        $this->app->bind(\App\Repository\Manager\Question\MissionQuestionRepositoryInterface::class, \App\Repository\Manager\Question\MissionQuestionRepository::class);
        //password
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);

        //api
        $this->app->bind(MissionBaseRepositoryInterface::class, MissionBaseRepository::class);
        $this->app->bind(MissionQuestionAnswerBaseRepositoryInterface::class, MissionQuestionAnswerBaseRepository::class);
        $this->app->bind(\App\Repository\Api\Team\TeamRepositoryInterface::class, \App\Repository\Api\Team\TeamRepository::class);
        $this->app->bind(\App\Repository\Api\Team\TeamMemberRepositoryInterface::class, \App\Repository\Api\Team\TeamMemberRepository::class);
        $this->app->bind(\App\Repository\Api\Program\ProgramRepositoryInterface::class, \App\Repository\Api\Program\ProgramRepository::class);
        $this->app->bind(\App\Repository\Api\User\UserRepositoryInterface::class, \App\Repository\Api\User\UserRepository::class);
        $this->app->bind(\App\Repository\Api\Mission\MissionRepositoryInterface::class, \App\Repository\Api\Mission\MissionRepository::class);
        $this->app->bind(\App\Repository\Api\Mission\MissionQuestionAnswerRepositoryInterface::class, \App\Repository\Api\Mission\MissionQuestionAnswerRepository::class);
        $this->app->bind(\App\Repository\Api\Feedback\FeedbackRepositoryInterface::class, \App\Repository\Api\Feedback\FeedbackRepository::class);
        $this->app->bind(\App\Repository\Api\ProgramMission\ProgramMissionRepositoryInterface::class, \App\Repository\Api\ProgramMission\ProgramMissionRepository::class);
        $this->app->bind(FeedbackBaseRepositoryInterface::class, FeedbackBaseRepository::class);
        $this->app->bind(\App\Repository\Api\UserLogin\UserLoginRepositoryInterface::class, \App\Repository\Api\UserLogin\UserLoginRepository::class);
        $this->app->bind(\App\Repository\Api\ProgramHistory\ProgramHistoryRepositoryInterface::class, \App\Repository\Api\ProgramHistory\ProgramHistoryRepository::class);
        $this->app->bind(BrandNotificationRepositoryInterface::class, BrandNotificationRepository::class);
        $this->app->bind(SystemNotificationRepositoryInterface::class, SystemNotificationRepository::class);
        $this->app->bind(MissionQuestionRepositoryInterface::class, MissionQuestionRepository::class);
    }
}