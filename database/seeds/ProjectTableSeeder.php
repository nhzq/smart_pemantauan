<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $faker = Faker\Factory::create();
            $project = new Project;
            $last_amount = Project::getLastRow()->pluck('total_amount')->first();
            $cost = 1000;
            
            $project->name = 'Projek ' . $faker->name . ' Fasa ' . $i;
            $project->cost = $cost;
            $project->total_amount = !empty($last_amount) ? $last_amount + $cost : $cost;
            $project->status = 1;
            $project->created_by = 1;
            $project->description = $faker->text;
            $project->save();
        }
    }
}
