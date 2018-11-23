<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LookupJabatan as Jabatan;

class UserTableSeeder extends Seeder
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
                'name' => 'Pengguna KU',
                'ic' => '1002',
                'lookup_department_id' => 2,
                'lookup_section_id' => null,
                'lookup_unit_id' => 1,
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Pengguna KS',
                'ic' => '1003',
                'lookup_department_id' => 2,
                'lookup_section_id' => 1,
                'lookup_unit_id' => null,
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Pengguna SUB',
                'ic' => '1004',
                'lookup_department_id' => 2,
                'lookup_section_id' => null,
                'lookup_unit_id' => null,
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Pengguna KW',
                'ic' => '1005',
                'lookup_department_id' => 2,
                'lookup_section_id' => null,
                'lookup_unit_id' => null,
                'password' => bcrypt('password')
            ],
        ];

        foreach ($inserts as $data) {
            User::create([
                'name' => $data['name'],
                'ic' => $data['ic'],
                'lookup_department_id' => $data['lookup_department_id'],
                'lookup_section_id' => $data['lookup_section_id'],
                'lookup_unit_id' => $data['lookup_unit_id'],
                'password' => $data['password']
            ]);
        }

        $user1 = User::where('ic', '1002')->first();
        $user1->assignRole('ku');

        $user2 = User::where('ic', '1003')->first();
        $user2->assignRole('ks');

        $user3 = User::where('ic', '1004')->first();
        $user3->assignRole('sub');

        $user4 = User::where('ic', '1005')->first();
        $user4->assignRole('kw');
    }
}
