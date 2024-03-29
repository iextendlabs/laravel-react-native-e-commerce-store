<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            productSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'umar ',
            'email' => 'umar@gmail.com',
            'admin' => 1,
            'password' => Hash::make('password')
        ]);
    }
}
