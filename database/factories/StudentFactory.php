<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admission_number' => $this->faker->unique()->numerify('ADM#####'),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'academic_classes_id' => $this->faker->numberBetween(1, 5), // Adjust range according to your academic classes
            'guardians_id' => $this->faker->numberBetween(1, 50), // Adjust range according to your guardians
            'user_id' => $this->faker->numberBetween(1, 1000000), // Adjust range according to your users
        ];
    }
}
