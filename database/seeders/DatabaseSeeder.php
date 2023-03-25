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
        \App\Models\Team::factory()->create(['name' => 'guests']);
        \App\Models\Team::factory()->create(['name' => 'admins']);
        \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@its.local',
             'role' => 'admin',
             'password' => Hash::make('admin'),
             'team_id' => 2
        ]);
        \App\Models\User::factory(10)->create();
    }
}
