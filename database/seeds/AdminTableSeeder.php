<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LookupJabatan as Jabatan;

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
                'kod' => 'DEV001', 
                'nama' => 'Developer'
            ],
            [
                'kod' => 'BTM', 
                'nama' => 'Jabatan Bahagian Teknologi Maklumat'
            ]
        ];

        foreach ($data as $d) {
            Jabatan::create(['kod' => $d['kod'], 'nama' => $d['nama']]);
        }


        $jabatan_id = Jabatan::where('kod', 'DEV001')->pluck('id')->first();

        // Admin
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'lookup_jabatan_id' => $jabatan_id,
            'email' => 'admin@email.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('superadmin');
    }
}
