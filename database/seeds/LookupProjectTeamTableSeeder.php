<?php

use Illuminate\Database\Seeder;
use App\Models\LookupProjectTeam as Team;

class LookupProjectTeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [
            'Pasukan Projek',
            'Jawatankuasa Teknikal',
            'Jawatankuasa Pemandu',
            'Jawatankuasa Pemantauan Smart Selangor',
            'Pengerusi',
            'Pengarah',
            'Pengurus',
            'Pejabat Pengurusan Projek (PMO)',
            'Pasukan SME',
            'Pasukan Pengurusan Perubahan',
            'Pasukan ICT: Pembangunan Aplikasi',
            'Pasukan ICT: Infrastruktur Aplikasi',
            'Ahli Jawatankuasa',
            'Wakil Pembekal'
        ];

        foreach ($inserts as $data) {
            Team::create([
                'name' => $data
            ]);
        }
    }
}
