<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Database\Factories\StudentFactory;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::factory()->count(100)->create();
    }
}
