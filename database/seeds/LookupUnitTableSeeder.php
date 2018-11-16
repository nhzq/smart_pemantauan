<?php

use Illuminate\Database\Seeder;
use App\Models\LookupUnit as Unit;

class LookupUnitTableSeeder extends Seeder
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
                'name' => 'ku-1',
                'displayed_name' => 'Kumpulan Sub Unit 1'
            ],
            [
                'name' => 'ku-2',
                'displayed_name' => 'Kumpulan Sub Unit 2'
            ],
            [
                'name' => 'ku-3',
                'displayed_name' => 'Kumpulan Sub Unit 3'
            ],
            [
                'name' => 'ku-4',
                'displayed_name' => 'Kumpulan Sub Unit 4'
            ],
            [
                'name' => 'ku-5',
                'displayed_name' => 'Kumpulan Sub Unit 5'
            ],
            [
                'name' => 'ku-6',
                'displayed_name' => 'Kumpulan Sub Unit 6'
            ]
        ];

        foreach ($data as $d) {
            Unit::create([
                'name' => $d['name'],
                'displayed_name' => $d['displayed_name']
            ]);
        }
    }
}
