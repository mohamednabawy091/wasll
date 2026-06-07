<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'mohamed nabawy',
            'email' => 'mohamednabawy091@gmail.com',
            'password' => Hash::make('m123456789'),
            'email_verified_at' => now(),
            'phone' => '01023696811',
            'user_type' => 'admin',
            'is_verified' => 1,

        ]);
    }
}
