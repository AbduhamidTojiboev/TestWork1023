<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test',
                'email' => 'Test@mail.com',
                'password' => Hash::make('password'),
            ],
        ];

        $role = Role::query()->where('name', \App\Common\Helpers\Role::SADMIN)->first();

        foreach ($users as $user) {
            try {
                $user = User::create($user);

                if ($user->email == 'admin@mail.com') {
                    $user->roles()->sync([$role->id]);
                }
            } catch (\Exception $exception) {

            }
        }
    }
}
