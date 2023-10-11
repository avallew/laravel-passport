<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $client = new ClientRepository();

        $client->createPasswordGrantClient(null, 'UaQj32GbSmUehX7aCQN6wXKVwgK3G9o8hkSpgUPT', 'http://localhost', 'users');
        $client->createPersonalAccessClient(null, 'E2HF9Cl9gojgSV7Npey1WbliRhacCHgIaeaHs0Tx', 'http://localhost', 'users');

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
