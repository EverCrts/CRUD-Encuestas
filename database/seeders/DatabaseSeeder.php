<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Survey;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            //User::factory(10)->create();
            //Survey::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Survey::factory()->create([
        //     'name' => 'Test Survey',
        //     'description' => 'Test description',
        //     'is_active' => true,
        //     'is_anonymous' => false,
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);

        Survey::create([
            'name' => 'Test Survey',
            'description' => 'Test description',
            'user_id' => 1,
            'is_active' => true,
            'is_anonymous' => false,
        ]);

    }
}
