<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LookupTeamRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [
            [
                'team_id' => 1, 'role_id' => 5
            ],
            [
                'team_id' => 1, 'role_id' => 6
            ],
            [
                'team_id' => 1, 'role_id' => 7
            ],
            [
                'team_id' => 1, 'role_id' => 8
            ],
            [
                'team_id' => 1, 'role_id' => 9
            ],
            [
                'team_id' => 1, 'role_id' => 10
            ],
            [
                'team_id' => 1, 'role_id' => 11
            ],
            [
                'team_id' => 1, 'role_id' => 12
            ],
            [
                'team_id' => 2, 'role_id' => 5
            ],
            [
                'team_id' => 2, 'role_id' => 6
            ],
            [
                'team_id' => 2, 'role_id' => 7
            ],
            [
                'team_id' => 2, 'role_id' => 8
            ],
            [
                'team_id' => 2, 'role_id' => 13
            ],
            [
                'team_id' => 3, 'role_id' => 5
            ],
            [
                'team_id' => 3, 'role_id' => 6
            ],
            [
                'team_id' => 3, 'role_id' => 7
            ],
            [
                'team_id' => 3, 'role_id' => 8
            ],
            [
                'team_id' => 3, 'role_id' => 9
            ],
            [
                'team_id' => 3, 'role_id' => 13
            ],
            [
                'team_id' => 3, 'role_id' => 14
            ],
            [
                'team_id' => 4, 'role_id' => 5
            ],
            [
                'team_id' => 4, 'role_id' => 6
            ],
            [
                'team_id' => 4, 'role_id' => 7
            ],
            [
                'team_id' => 4, 'role_id' => 8
            ],
            [
                'team_id' => 4, 'role_id' => 9
            ],
            [
                'team_id' => 4, 'role_id' => 13
            ],
            [
                'team_id' => 4, 'role_id' => 14
            ]
        ];

        foreach ($inserts as $data) {
            DB::table('team_role')->insert([
                'team_id' => $data['team_id'],
                'role_id' => $data['role_id']
            ]);
        }
    }
}
