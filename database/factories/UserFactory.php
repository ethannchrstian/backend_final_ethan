<?php


namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;


class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'), 
            'role' => 'user',
            'idadmin' => null, 
        ];
    }

  
    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'email' => 'admin@example.com',
            'phone_number' => '081234567890',
            'idadmin' => fake()->unique()->randomNumber(5),
        ]);
    }
}

