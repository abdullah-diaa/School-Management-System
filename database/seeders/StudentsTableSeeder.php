<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data from the table
        Student::truncate();

        // Seed the students table with sample data
        for ($i = 1; $i <= 20; $i++) {
            Student::create([
                'admission_number' => 'A' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'first_name' => 'Student' . $i,
                'last_name' => 'Doe',
                'date_of_birth' => '1990-01-01',
                'gender' => ($i % 2 == 0) ? 'Male' : 'Female',
                'address' => '123 Main St',
                'phone_number' => '555-1234',
                'email' => 'student' . $i . '@example.com',
                'parent_contact' => '555-5678',
                'class_id' => rand(1, 5), // Adjust class_id based on your actual classes
                'parent_id' => rand(1, 10), // Adjust parent_id based on your actual parents
            ]);
        }
    }
}
