<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{

    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'is_default' => $this->faker->boolean
        ];
    }

}
