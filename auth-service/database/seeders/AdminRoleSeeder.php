<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminRoleSeeder extends Seeder
{

    protected $faker;

    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminId = 'admin';
        $adminRoleAttributes = [
            'id' => $adminId,
            'name' => 'Administrator',
            'is_default' => false
        ];
        if (!Role::query()->find($adminId)) {
            Role::query()->create($adminRoleAttributes);
        }
        if (!User::query()->where('email', 'admin@admin.com')->first()) {
            $user = User::factory([
                "email" => "admin@admin.com",
                "password" => Hash::make("QWEasd123"),
            ])->create();
            $user->roles()->attach($adminId);
        }
    }
}
