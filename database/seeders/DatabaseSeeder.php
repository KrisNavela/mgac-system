<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            //'branch_id' => '1',
            //'role_id' => '1',
            //'first_name' => 'Test First Name',
            //'last_name' => 'Test Last Name',
            //'email' => 'test@example.com',
            //'password' => '12345678',
        ]);
    }
}
