<?php
/**
 * Created by PhpStorm
 * Author: Kha Nam
 * Date: 20/05/2021
 * Time: 2:36 PM
 **/


namespace App\Service\Manager;


use App\Helpers\Helpers;
use App\Repository\Manager\Feedback\FeedbackBaseRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackRepositoryInterface;
use App\Repository\Manager\Mission\MissionBaseRepositoryInterface;
use App\Repository\Manager\Mission\MissionRepositoryInterface;
use App\Repository\Manager\MissionQuestionAnswer\MissionQuestionAnswerRepositoryInterface;
use App\Repository\Manager\Program\ProgramMissionRepositoryInterface;
use App\Repository\Manager\Program\ProgramRepositoryInterface;
use App\Repository\Manager\Team\TeamRepositoryInterface;
use App\Repository\Manager\TeamMember\TeamMemberRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProgramService
{
    private $programRepository;
    private $programMissionRepository;
    private $missionRepository;
    private $feedbackRepository;
    private $missionQuestionAnswerRepository;
    private $missionBaseRepository;
    private $teamMemberRepository;
    private $teamRepository;
    private $feedbackBaseRepository;

    public function __construct(ProgramRepositoryInterface $programRepository, ProgramMissionRepositoryInterface $programMissionRepository,
                                MissionRepositoryInterface $missionRepository, FeedbackRepositoryInterface $feedbackRepository,
                                MissionQuestionAnswerRepositoryInterface $missionQuestionAnswerRepository, MissionBaseRepositoryInterface $missionBaseRepository,
                                TeamMemberRepositoryInterface $teamMemberRepository, TeamRepositoryInterface $teamRepository,
                                FeedbackBaseRepositoryInterface $feedbackBaseRepository)
    {
        $this->programRepository = $programRepository;
        $this->programMissionRepository = $programMissionRepository;
        $this->missionRepository = $missionRepository;
        $this->feedbackRepository = $feedbackRepository;
        $this->missionQuestionAnswerRepository = $missionQuestionAnswerRepository;
        $this->missionBaseRepository = $missionBaseRepository;
        $this->teamMemberRepository = $teamMemberRepository;
        $this->teamRepository = $teamRepository;
        $this->feedbackBaseRepository = $feedbackBaseRepository;
    }

    public function getList($perPage)
    {
        return $this->programRepository->getList($perPage);
    }

    public function findById($id)
    {
        return $this->programRepository->findById($id);
    }

    public function update($id, $data)
    {

        DB::beginTransaction();
        try {
            $dataUpdate = [
                'name' => $data['name'],
                'detail' => $data['detail'],
                'status' => $data['status'],
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (request()->file('thumbnail_url') != null) {
                $upload = Helpers::upLoadFile(request()->file('thumbnail_url'), 'program');
                if ($upload['meta']['status'] == 200) $dataUpdate['thumbnail_url'] = $upload['response'];
            }
            if (!$this->programRepository->update($id, $dataUpdate)) {
                DB::rollBack();
                return false;
            }
            if (isset($data['mission'])) {
                $programMission = $this->programMissionRepository->getListByProgramId($id)->pluck('mission_id')->toArray();
                $missionBaseIdNewInProgram = array_diff(array_keys($data['mission']), $programMission);
                $missionBaseIdRemoveInProgram = array_diff($programMission, array_keys($data['mission']));
                foreach ($missionBaseIdRemoveInProgram as $value){
                    $this->programMissionRepository->deleteByProgram(['program_id' => $id, 'mission_base_id' => $value]);
                }
                foreach ($missionBaseIdNewInProgram as $value){
                    $dataInsertProgramMission = [
                        'program_id' => $id,
                        'mission_id' => $value,
                        'delivery_date_number' => $data['mission'][$value],
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ];
                    if (!$this->programMissionRepository->store($dataInsertProgramMission)){
                        DB::rollBack();
                        return  false;
                    }
                }
            } else{
                if (!$this->programMissionRepository->deleteByProgram(['program_id' => $id])){
                    DB::rollBack();
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $dataInsert = [
                'name' => $data['name'],
                'detail' => $data['detail'],
                'status' => $data['status'],
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            if (request()->file('thumbnail_url') != null) {
                $upload = Helpers::upLoadFile(request()->file('thumbnail_url'), 'program');
                if ($upload['meta']['status'] == 200) $dataInsert['thumbnail_url'] = $upload['response'];
            }
            $programId = $this->programRepository->store($dataInsert);
            if (!$programId) {
                DB::rollBack();
                return false;
            }
            if (isset($data['mission'])) {
                foreach ($data['mission'] as $missionId => $value) {
                    $dataInsertProgramMission = [
                        'program_id' => $programId,
                        'mission_id' => $missionId,
                        'delivery_date_number' => $value,
                        'created_at' => date('Y/m/d H:i:s'),
                        'updated_at' => date('Y/m/d H:i:s')
                    ];
                    if (!$this->programMissionRepository->store($dataInsertProgramMission)) {
                        DB::rollBack();
                        return false;
                    }
                }
            }
            DB::commit();
            return $programId;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}