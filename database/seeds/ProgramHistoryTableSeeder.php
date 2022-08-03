<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_histories')->insert([
            [
                'program_id' => 1,
                'team_id' => 1,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'program_id' => 2,
                'team_id' => 2,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'program_id' => 3,
                'team_id' => 3,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ]
        ]);
    }
}
