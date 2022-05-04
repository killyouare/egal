<?php

namespace Database\Seeders;

use App\Events\SendMessageEvent;
use App\Models\Role;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class UsersDebugSeeder extends Seeder
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        /** @var Role $role */
        $role = Role::factory()->create();

        $users = User::factory()->count(5)->create();
        /** @var User $user */
        foreach ($users as $user) {
            $user->roles()->attach($role->id);
        }
    }
}
