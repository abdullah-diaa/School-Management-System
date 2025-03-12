<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'user_name' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' =>'password', // Default password
            'role' => $this->faker->randomElement(['Admin', 'Student', 'Teacher']),
            'date_of_birth' => $this->faker->date(),
            'profile_picture' => null, // You can customize this based on your needs
            'region' => $this->faker->city,
        ];
    }
}

