<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Superadmin',
            'Ketua Unit',
            'Ketua Seksyen',
            'Ketua Jabatan Bahagian Teknologi Maklumat',
            'Kewangan',
            'Unisel',
            'SSDU'
        ];

        $roles = [
            'superadmin',
            'ku',
            'ks',
            'sub',
            'kw',
            'unisel',
            'ssdu'
        ];

        foreach (array_combine($roles, $names) as $role => $name) {
            Role::create([
                'displayed_name' => $name,
                'name' => $role
            ]);
        }
    }
}
