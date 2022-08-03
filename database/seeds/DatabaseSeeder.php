<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BrandTableSeeder::class);
         $this->call(MissionBaseTableSeeder::class);
         $this->call(MissionTableSeeder::class);
         $this->call(ProgramTableSeeder::class);
         $this->call(TeamTableSeeder::class);
         $this->call(TeamMemberTableSeeder::class);
         $this->call(AdminTableSeeder::class);
         $this->call(UserTableSeeder::class);
         $this->call(QuestionBaseSeeder::class);
         $this->call(LoginHistorySeeder::class);
         $this->call(ProgramHistoryTableSeeder::class);
         $this->call(MissionQuestionAnswerTableSeeder::class);
         $this->call(FeedbackBaseTableSeeder::class);
         $this->call(ProgramMissionTableSeeder::class);
         $this->call(FeedbackTableSeeder::class);
    }
}
