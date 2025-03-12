<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Guardian;
use Database\Factories\GuardianFactory;

class GuardianSeeder extends Seeder
{
    public function run()
    {
        // Using the factory to create 5 academic classes
        GuardianFactory::new()->count(35)->create();
    }
}