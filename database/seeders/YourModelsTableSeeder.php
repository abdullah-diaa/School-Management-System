<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YourModel;

class YourModelsTableSeeder extends Seeder
{
    public function run()
    {
        YourModel::create([
            'column_name' => 'Sample Data',
            // Add other data as needed
        ]);

        // Add more records as needed
    }
}
