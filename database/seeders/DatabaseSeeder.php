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

        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => '123123123',
            ],
            [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => '123123123',
            ],
            [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => '123123123',
            ],
            [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => '123123123',
            ],
            [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => '123123123',
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
