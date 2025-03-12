<?php
namespace Database\Seeders;

// database/seeders/AcademicClassSeeder.php

use Illuminate\Database\Seeder;
use App\Models\AcademicClass;
use Database\Factories\AcademicClassFactory; // Ensure to use the correct namespace

class AcademicClassSeeder extends Seeder
{
    public function run()
    {
        // Using the factory to create 5 academic classes
        AcademicClassFactory::new()->count(35)->create();
    }
}
