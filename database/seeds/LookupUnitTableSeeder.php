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
                'lookup_section_id' => 1,
                'name' => 'ku-1',
                'displayed_name' => 'Unit Operasi dan Sokongan Teknikal'
            ],
            [
                'lookup_section_id' => 1,
                'name' => 'ku-2',
                'displayed_name' => 'Unit Pusat Data, Rangkaian, dan Keselamatan'
            ],
            [
                'lookup_section_id' => 2,
                'name' => 'ku-3',
                'displayed_name' => 'Unit Pembangunan Aplikasi 1'
            ],
            [
                'lookup_section_id' => 2,
                'name' => 'ku-4',
                'displayed_name' => 'Unit Pembangunan Aplikasi 2'
            ],
            [
                'lookup_section_id' => 2,
                'name' => 'ku-5',
                'displayed_name' => 'Unit Web'
            ],
            [
                'lookup_section_id' => 2,
                'name' => 'ku-6',
                'displayed_name' => 'Unit Kualiti dan Strategik'
            ]
        ];

        foreach ($data as $d) {
            Unit::create([
                'lookup_section_id' => $d['lookup_section_id'],
                'name' => $d['name'],
                'displayed_name' => $d['displayed_name']
            ]);
        }
    }
}
