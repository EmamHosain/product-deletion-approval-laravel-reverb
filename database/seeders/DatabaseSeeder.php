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
        User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'password',
        ]);

        $this->call(ProductSeeder::class);
    }
}
