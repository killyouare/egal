<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersDebugSeeder extends Seeder
{

    public function run()
    {
        Role::factory([
            'name' => 'admin',
            'is_default' => false,
        ])->create();
        User::factory([
            "email" => "admin@admin.com",
            "password" => "QWEasd123"
        ])->create();


        /** @var Role $role */
        $role = Role::factory()->create();

        $users = User::factory()->count(5)->create();
        /** @var User $user */
        foreach ($users as $user) {
            $user->roles()->attach($role->id);
        }
    }
}
