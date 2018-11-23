<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(LookupSectionTableSeeder::class);
        $this->call(LookupUnitTableSeeder::class);
        $this->call(LookupBudgetTableSeeder::class);
        $this->call(LookupCollectionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(LookupProjectTeamTableSeeder::class);
        $this->call(LookupTeamRoleTableSeeder::class);
    }
}
