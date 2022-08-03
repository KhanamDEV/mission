<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name' => 'Team 1',
                'detail' => 'Detail team 1',
                'thumbnail_url' => 'brand/1632966646.png',
                'brand_id' => 1,
                'program_id' => 1,
                'program_started_at' => date('Y/m/d H:i:s'),
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'name' => 'Team 2',
                'detail' => 'Detail team 2',
                'thumbnail_url' => 'brand/1632970167.png',
                'brand_id' => 1,
                'program_id' => 2,
                'program_started_at' => date('Y/m/d H:i:s', strtotime('2021/04/01')),
                'created_at' => date('Y/m/d H:i:s', strtotime('2021/04/01')),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'name' => 'Team 3',
                'detail' => 'Detail team 3',
                'thumbnail_url' => 'brand/1632970184.png',
                'brand_id' => 2,
                'program_id' => 3,
                'program_started_at' => date('Y/m/d H:i:s', strtotime('2021/04/01')),
                'created_at' => date('Y/m/d H:i:s', strtotime('2021/04/01')),
                'updated_at' => date('Y/m/d H:i:s')
            ],
            [
                'name' => 'Team 4',
                'detail' => 'Detail team 4',
                'thumbnail_url' => 'brand/1632970205.png',
                'brand_id' => 2,
                'program_id' => 1,
                'program_started_at' => date('Y/m/d H:i:s'),
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ]
        ]);
    }
}
