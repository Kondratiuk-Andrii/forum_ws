<?php

namespace Database\Seeders;

use App\Models\Section;
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

        $data = require __DIR__ . '/seedData.php';

        foreach ($data['users'] as $user) {
            User::factory()->create($user);
        }

        foreach ($data['sections'] as $section) {
            Section::factory()->create($section);
        }

    }
}
