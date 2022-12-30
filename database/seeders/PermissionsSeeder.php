<?php

namespace Database\Seeders;

use App\Common\Helpers\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            //USER
            ['name' => Permission::USER_LIST, 'display_name' => 'Пользователи : Раздел\Список'],
            ['name' => Permission::USER_SHOW, 'display_name' => 'Пользователи : Просмотр'],
            ['name' => Permission::USER_CREATE, 'display_name' => 'Пользователи : Добавление'],
            ['name' => Permission::USER_DELETE, 'display_name' => 'Пользователи : Удаление'],
            ['name' => Permission::USER_EDIT, 'display_name' => 'Пользователи : Редактирование'],

            //ROLE
            ['name' => Permission::ROLE_LIST, 'display_name' => 'Роль : Раздел\Список'],
            ['name' => Permission::ROLE_SHOW, 'display_name' => 'Роль : Просмотр'],
            ['name' => Permission::ROLE_CREATE, 'display_name' => 'Роль : Добавление'],
            ['name' => Permission::ROLE_DELETE, 'display_name' => 'Роль : Удаление'],
            ['name' => Permission::ROLE_EDIT, 'display_name' => 'Роль : Редактирование'],

            //POST
            ['name' => Permission::POST_LIST, 'display_name' => 'Пост : Раздел\Список'],
            ['name' => Permission::POST_SHOW, 'display_name' => 'Пост : Просмотр'],
            ['name' => Permission::POST_CREATE, 'display_name' => 'Пост : Добавление'],
            ['name' => Permission::POST_DELETE, 'display_name' => 'Пост : Удаление'],
            ['name' => Permission::POST_EDIT, 'display_name' => 'Пост : Редактирование'],
        ];

        foreach ($permissions as $permission) {
            try {
                \App\Models\Permission::create($permission);
            } catch (\Exception $e) {
            }
        }
    }
}
