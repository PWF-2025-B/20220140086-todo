<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Todo;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        
User::factory()->create([
            'name' => 'Muhamad Adri Muwaffaq Khamid', // Ganti dengan nama lengkap kamu
            'email' => 'adri.example@mail.com', // Ganti dengan email kamu
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => false,
        ]);     // Membuat 100 todo secara otomati    
    }
}