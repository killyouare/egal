<?php

namespace Database\Seeders;

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
        $this->call(AuthenticatePermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(AdminRoleSeeder::class);
        $this->call(DeveloperRoleSeeder::class);
    }
}
