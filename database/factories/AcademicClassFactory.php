<?php
namespace Database\Factories;

use App\Models\AcademicClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicClassFactory extends Factory
{
    protected $model = AcademicClass::class;

    public function definition()
    {
        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 year');

        return [
            'class_name' => $this->faker->unique()->sentence(2),
            'class_level' => $this->faker->randomElement(['Grade 1', 'Grade 2', 'High School - Junior', 'High School - Senior']),
            'class_description' => $this->faker->paragraph,
            'class_teacher_id' => null,
            'capacity' => $this->faker->numberBetween(20, 30),
            'start_date' => $startDate,
            'end_date' => $endDate,
            // ... other fields
        ];
    }
}
