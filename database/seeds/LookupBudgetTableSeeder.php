<?php

use Illuminate\Database\Seeder;
use App\Models\LookupBudgetType as Budget;
use App\Models\LookupSubBudgetType as SubBudget;

class LookupBudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budgets = [
            [
                'lookup_department_id' => 2,
                'code' => 'P01',
                'description' => 'Pembangunan'
            ],
            [
                'lookup_department_id' => 2,
                'code' => 'B01',
                'description' => 'Pengurusan'
            ]
        ];

        $sub = [
            [
                [
                    'lookup_budget_type_id' => 1,
                    'code' => '11001',
                    'description' => 'Pembangunan ICT'
                ], 
                [
                    'lookup_budget_type_id' => 1,
                    'code' => '11002',
                    'description' => 'Program Sains, Teknologi Dan Inovasi (Standco Sti Negeri Selangor)'
                ],
                [
                    'lookup_budget_type_id' => 1,
                    'code' => '11003',
                    'description' => 'Projek Smart Selangor'
                ]
            ],
            [
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '15000',
                    'description' => 'Faedah-faedah Kewangan Lain'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '21000',
                    'description' => 'Perbelanjaan Perjalanan Sara Hidup'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '23000',
                    'description' => 'Perhubungan dan Utiliti'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '24000',
                    'description' => 'Sewaan'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '27000',
                    'description' => 'Bekalan dan Bahan-bahan Lain'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '28000',
                    'description' => 'Penyelenggaraan dan Pembaikan Kecil Yang Dibeli'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '29000',
                    'description' => 'Perkhidmatan Ikhtisas Dan Perkhidmatan Lain Yang Dibeli dan Hospitaliti'
                ],
                [
                    'lookup_budget_type_id' => 2,
                    'code' => '35000',
                    'description' => 'Harta Modal'
                ]
            ]
        ];

        foreach ($budgets as $budget) {
            Budget::create([
                'lookup_department_id' => $budget['lookup_department_id'],
                'code' => $budget['code'],
                'description' => $budget['description']
            ]);
        }

        foreach ($sub as $data) {
            foreach ($data as $d) {
                SubBudget::create([
                    'lookup_budget_type_id' => $d['lookup_budget_type_id'],
                    'code' => $d['code'],
                    'description' => $d['description']
                ]);
            }
        }
    }
}
