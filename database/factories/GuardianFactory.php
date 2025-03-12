<?php
namespace Database\Factories;

use App\Models\Guardian;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuardianFactory extends Factory
{
    protected $model = Guardian::class;

    public function definition()
    {
        return [
            'father_name' => $this->faker->firstNameMale,
            'mother_name' => $this->faker->firstNameFemale,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            // Add other fields as needed
        ];
    }
}
