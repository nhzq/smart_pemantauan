<?php

use Illuminate\Database\Seeder;
use App\Models\LookupSection as Section;

class LookupSectionTableSeeder extends Seeder
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
                'name' => 'ks-1',
                'displayed_name' => 'Seksyen Operasi, Rangkaian, dan Keselamatan',
            ],
            [
                'name' => 'ks-2',
                'displayed_name' => 'Seksyen Strategik dan Maklumat',
            ]
        ];
        
        foreach ($inserts as $insert) {
            Section::create([
                'name' => $insert['name'],
                'displayed_name' => $insert['displayed_name'],
            ]);
        }
    }
}
