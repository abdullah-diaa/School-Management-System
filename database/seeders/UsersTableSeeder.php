<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'user_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        // Create 145 student users
        User::factory()->count(145)->create(['role' => 'Student']);

        // Create 5 teacher users
        User::factory()->count(5)->create(['role' => 'Teacher']);
    }
}
