<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'email' => $this->faker->unique()->email(),
            'password' => $this->faker->password(),
            "first_name" => $this->faker->name(),
            "last_name" => $this->faker->lastName(),
            "phone" => $this->faker->unique()->e164PhoneNumber(),
        ];
    }
}
