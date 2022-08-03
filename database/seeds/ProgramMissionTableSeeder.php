<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramMissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_missions')->insert([
            [
                'program_id' => 1,
                'mission_id' => 1,
                'delivery_date_number' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 1,
                'mission_id' => 2,
                'delivery_date_number' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 1,
                'mission_id' => 3,
                'delivery_date_number' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 2,
                'mission_id' => 4,
                'delivery_date_number' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 2,
                'mission_id' => 5,
                'delivery_date_number' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 2,
                'mission_id' => 6,
                'delivery_date_number' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 3,
                'mission_id' => 7,
                'delivery_date_number' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 3,
                'mission_id' => 8,
                'delivery_date_number' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 3,
                'mission_id' => 9,
                'delivery_date_number' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'program_id' => 3,
                'mission_id' => 10,
                'delivery_date_number' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
