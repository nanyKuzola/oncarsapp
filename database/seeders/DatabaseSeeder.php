<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use  Database\Seeders\UserSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        # run seeders available
        $this->call([
            UserSeeder::class,
            CarSeeder::class,
            SimulationSeeder::class,
        ]);
    }
}
