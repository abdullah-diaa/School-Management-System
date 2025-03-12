<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed other seeders here
        $this->call([
            UsersTableSeeder::class,
            AcademicClassSeeder::class,
            GuardianSeeder::class,
            StudentSeeder::class,
            // Add more seeders as needed
        ]);
    }
}
