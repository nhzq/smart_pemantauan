<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LookupDepartment as Department;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'code' => 'DEV001', 
                'name' => 'Developer'
            ],
            [
                'code' => 'BTM', 
                'name' => 'Jabatan Bahagian Teknologi Maklumat'
            ]
        ];

        foreach ($data as $d) {
            Department::create([
                'code' => $d['code'], 
                'name' => $d['name']
            ]);
        }


        $department_id = Department::where('code', 'DEV001')->pluck('id')->first();

        // Admin
        $user = User::create([
            'name' => 'Admin',
            'ic' => '1001',
            'lookup_department_id' => $department_id,
            'lookup_section_id' => null,
            'lookup_unit_id' => null,
            'password' => bcrypt('password')
        ]);

        $user->assignRole('superadmin');
    }
}
