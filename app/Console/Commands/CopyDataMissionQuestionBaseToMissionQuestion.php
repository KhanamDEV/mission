<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CopyDataMissionQuestionBaseToMissionQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CopyDataMissionQuestionBaseToMissionQuestion';

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
    public function handle()
    {
        DB::beginTransaction();
        try {
            $missions = DB::table('missions')->get();
            foreach ($missions as $mission){
                $missionQuestionAnswerBase = DB::table('mission_question_answer_bases')->where('mission_base_id', $mission->mission_base_id)->get();
                foreach ($missionQuestionAnswerBase as $question){
                    if (!DB::table('mission_questions')->insert([
                        'mission_id'=> $mission->id,
                        'mission_question_answer_base_id' => $question->id,
                        'title' => $question->title,
                        'type' =>$question->type,
                        'choice' => $question->choice,
                        'delivery_order_number'  =>$question->delivery_order_number,
                        'created_at' => $mission->created_at,
                        'updated_at' => $mission->created_at
                    ])) {
                        DB::rollBack();
                        $this->info('Has error');
                        return false;
                    }

                }
            }
            DB::commit();
            $this->info('Copy Success !');
        } catch (\Exception $e){
            DB::rollBack();
            $this->info($e->getMessage());
        }

    }
}
