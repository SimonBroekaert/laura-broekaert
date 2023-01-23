<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create developer user
        $simon = User::factory()
            ->developer()
            ->create([
                'name' => 'Simon Broekaert',
                'email' => 'info@simonbroekaert.be',
            ]);

        // Create admin user
        $laura = User::factory()
            ->admin()
            ->create([
                'name' => 'Laura Broekaert',
                'email' => 'laurabroekaert@gmail.com',
            ]);
    }
}
