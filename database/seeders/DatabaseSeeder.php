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
        \App\Models\Team::factory()->create(['name' => 'guests', 'description' => 'Team for guests', 'hidden' => True]);
        \App\Models\Team::factory()->create(['name' => 'admins', 'description' => 'Administrator Team', 'hidden' => True]);
        \App\Models\Team::factory()->create(['name' => 'developers', 'description' => 'Developers Team', 'hidden' => False]);
        \App\Models\User::factory()->create([
             'name' => 'great admin',
             'email' => 'admin@its.local',
             'role' => 'admin',
             'password' => Hash::make('admin'),
             'team_id' => 2
        ]);
        \App\Models\User::factory()->create([
             'name' => 'developers manager',
             'email' => 'dev@its.local',
             'role' => 'team-admin',
             'password' => Hash::make('dev'),
             'team_id' => 3
        ]);
        \App\Models\User::factory()->create([
             'name' => 'developer',
             'email' => 'member@its.local',
             'role' => 'member',
             'password' => Hash::make('admin'),
             'team_id' => 3
        ]);
    }
}
