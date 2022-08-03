<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('team_members')->insert([
            [
                'user_id' => 1,
                'is_leader' => 1,
                'team_id' => 1,
                'brand_id' => 1,
                'is_active' => 1
            ],
            [
                'user_id' => 2,
                'is_leader' => 0,
                'team_id' => 1,
                'brand_id' => 1,
                'is_active' => 1
            ],
            [
                'user_id' => 3,
                'is_leader' => 0,
                'team_id' => 1,
                'brand_id' => 1,
                'is_active' => 1
            ],
            [
                'user_id' => 1,
                'is_leader' => 0,
                'team_id' => 2,
                'brand_id' => 1,
                'is_active' => 1
            ],
            [
                'user_id' => 4,
                'is_leader' => 1,
                'team_id' => 2,
                'brand_id' => 1,
                'is_active' => 1
            ],
            [
                'user_id' => 5,
                'is_leader' => 1,
                'team_id' => 3,
                'brand_id' => 2,
                'is_active' => 1
            ],
            [
                'user_id' => 6,
                'is_leader' => 0,
                'team_id' => 3,
                'brand_id' => 2,
                'is_active' => 1
            ],
            [
                'user_id' => 7,
                'is_leader' => 1,
                'team_id' => 4,
                'brand_id' => 2,
                'is_active' => 1
            ],
            [
                'user_id' => 8,
                'is_leader' => 0,
                'team_id' => 4,
                'brand_id' => 2,
                'is_active' => 1
            ],
            [
                'user_id' => 9,
                'is_leader' => 0,
                'team_id' => 4,
                'brand_id' => 2,
                'is_active' => 1
            ]
        ]);
    }
}
