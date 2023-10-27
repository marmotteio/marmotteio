<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@marmotte.io',
                'password' => Hash::make('marmotte.io'),
            ]);
        }
    }
}
