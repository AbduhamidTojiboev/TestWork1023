<?php

namespace Database\Seeders;

use App\Common\Helpers\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => Role::SADMIN, 'display_name' => 'Администратор'],
        ];

        foreach ($roles as $role) {
            try {
                \App\Models\Role::create($role);
            } catch (\Exception $e) {

            }
        }
    }
}
