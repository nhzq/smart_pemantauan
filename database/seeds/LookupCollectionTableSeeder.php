<?php

use Illuminate\Database\Seeder;
use App\Models\LookupCollectionType as Collection;

class LookupCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Sebutharga - Pesanan Tempahan (LO)',
            'Sebutharga B',
            'Sebutharga',
            'Tender',
            'Rundingan Terus',
            'Direct Grant'
        ];

        foreach ($names as $data) {
            Collection::create([
                'name' => $data
            ]);
        }
    }
}
