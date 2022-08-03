<?php

namespace App\Service\Manager;


use App\Helpers\Helpers;
use App\Repository\Manager\Feedback\FeedbackRepositoryInterface;
use App\Repository\Manager\Mission\MissionBaseRepositoryInterface;
use App\Repository\Manager\Feedback\FeedbackBaseRepositoryInterface;
use App\Repository\Manager\Question\QuestionBaseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;
class MissionBaseService
{
    private $mission_base_repository;
    private $quesion_base_repository;
    private $feedback_base_repository;
    private $feedback_repository;

    public function __construct(
        MissionBaseRepositoryInterface $mission_base_repository,
        QuestionBaseRepositoryInterface $quesion_base_repository,
        FeedBackBaseRepositoryInterface $feedback_base_repository, FeedbackRepositoryInterface $feedback_repository)
    {
        $this->mission_base_repository = $mission_base_repository;
        $this->quesion_base_repository = $quesion_base_repository;
        $this->feedback_base_repository = $feedback_base_repository;
        $this->feedback_repository = $feedback_repository;
    }

    public function getList($perPage = 10){
        return $this->mission_base_repository->getList($perPage);
    }

    public function findById($id){
        $mission_base = $this->mission_base_repository->findById($id);
        $mission_base->active = $this->mission_base_repository->checkUsed($id);
        return $mission_base;
    }

    public function store($request)
    {
        try {
            $questions = $request->question ?? [];

            if ($request->hasFile('mission_thumbnail')) {
                $mission_thumb_url = Helpers::upLoadFile( request()->file('mission_thumbnail') , 'mission','img');
                if ($mission_thumb_url['meta']['status'] == 200) {
                    $mission_thumb_url = $mission_thumb_url['response'];
                } else{
                    return false;
                }
            }else{
                $mission_thumb_url = null;
            }

            if ($request->hasFile('feedback_thumbnail')) {
                $feedback_thumb_url = Helpers::upLoadFile( request()->file('feedback_thumbnail') , 'feedback','img');
                if ($feedback_thumb_url['meta']['status'] == 200) {
                    $feedback_thumb_url = $feedback_thumb_url['response'];
                } else{
                    return false;
                }
            }else{
                $feedback_thumb_url = null;
            }
            if ($mission_thumb_url == null || $feedback_thumb_url == null) return false;
            $mission_id = $this->mission_base_repository->store([
                'name' => $request->mission_name,
                'detail' => $request->mission_detail,
                'thumbnail_url' => $mission_thumb_url,
                'is_target' => $request->mission_is_target,
                'time_required' => $request->time_required,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_anonymous' => $request->is_anonymous
            ]);
            if (!$mission_id) {
                DB::rollBack();
                return false;
            }
            $feedbackBaseId =  $this->feedback_base_repository->store([
                'mission_base_id' => $mission_id,
                'title' => $request->feedback_title,
                'detail' => $request->feedback_detail,
                'thumbnail_url' => $feedback_thumb_url,
                'hint_title'    => $request->feedback_hint_title,
                'hint_detail'   => $request->feedback_hint_detail,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if (!$feedbackBaseId) {
                DB::rollBack();
                return false;
            }
            foreach ($questions as $key => $question) {
                  $missionQuestionBaseId =  $this->quesion_base_repository->store([
                        'mission_base_id' => $mission_id,
                        'title' => $question['title'],
                        'type' => $question['format'],
                        'choice' => $question['choices'],
                        'delivery_order_number' => $question['order'],
                    ]);
                  if (!$missionQuestionBaseId){
                      DB::rollBack();
                      return false;
                  }
            }
            DB::commit();
            return $mission_id;
        } catch (\Exception $e){
            DB::rollBack();
            return false;
        }

    }

    public function update($id, $request)
    {
        $mission_base = $this->mission_base_repository->findById($id);
        $current_questions =  $mission_base->question_bases->pluck('id')->toArray();
        if (!$mission_base) {
            return false;
        }

        $questions = $request->question ?? []; 

        if ($request->hasFile('mission_thumbnail')) {
            $mission_thumb_url = Helpers::upLoadFile( request()->file('mission_thumbnail') , 'mission','img');
            if ($mission_thumb_url['meta']['status'] == 200) {
                $mission_thumb_url = $mission_thumb_url['response'];
            } else{
                return false;
            }
        }else{
            $mission_thumb_url = null;
        }

        if ($request->hasFile('feedback_thumbnail')) {
            $feedback_thumb_url = Helpers::upLoadFile( request()->file('feedback_thumbnail') , 'feedback','img');
            if ($feedback_thumb_url['meta']['status'] == 200) {
                $feedback_thumb_url = $feedback_thumb_url['response'];
            } else{
                return false;
            }
        }else{
            $feedback_thumb_url = null;
        }
        try {
            DB::beginTransaction();
            $dataUpdateMission = [
                'name' => $request->mission_name,
                'detail' => $request->mission_detail,
                'is_target' => $request->mission_is_target,
                'time_required' => $request->time_required,
                'is_anonymous' => $request->is_anonymous,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            if($mission_thumb_url != null) $dataUpdateMission['thumbnail_url'] = $mission_thumb_url;
            $this->mission_base_repository->update($id, $dataUpdateMission);
            $dataUpdateFeedback = [
                'mission_base_id' => $id,
                'title' => $request->feedback_title,
                'detail' => $request->feedback_detail,
                'hint_title'    => $request->feedback_hint_title,
                'hint_detail'   => $request->feedback_hint_detail,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if($feedback_thumb_url != null) $dataUpdateFeedback['thumbnail_url'] = $feedback_thumb_url;
            $this->feedback_base_repository->update($mission_base->feedback_base->id, $dataUpdateFeedback);
    
            foreach ($questions as $key => $question) {
                try {
                    if (in_array($key, $current_questions)) {                        
                        $this->quesion_base_repository->update(
                            $key, 
                        [
                            'title' => $question['title'],
                            'type' => $question['format'],
                            'choice' => $question['choices'],
                            'delivery_order_number' => $question['order'],
                        ]); 
                        $index = array_search($key, $current_questions);
                        unset($current_questions[$index]);
                    }else{
                        $this->quesion_base_repository->store([
                            'mission_base_id' => $id,
                            'title' => $question['title'],
                            'type' => $question['format'],
                            'choice' => $question['choices'],
                            'delivery_order_number' => $question['order'],
                        ]); 
                    }
    
                } catch (\Exception $e) {
                    // do nothing
                }
            }
    
            foreach ($current_questions as $key) {
                $this->quesion_base_repository->destroy($key);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return false;

        }   
        return $id;
    }

    public function destroy($id){
        if ($this->mission_base_repository->checkUsed($id)) return false;
        return $this->mission_base_repository->destroy($id);
    }
}