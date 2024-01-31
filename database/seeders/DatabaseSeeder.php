<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        //  \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'admin',
        //  ]);
        DB::table('users')->insert([
            // admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'admin',
                'status' => 'active',
            ],
            // agent
            [
                'name' => 'agent',
                'username' => 'agent',
                'email' => 'agent@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'agent',
                'status' => 'deactive',
            ],
            // user
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'user',
                'status' => 'active',
            ]
        ]);

    }
}
