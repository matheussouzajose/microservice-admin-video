<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Tests\Fixtures\UserFixtures;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'id' => UserFixtures::UUID_MATHEUS,
            'first_name' => UserFixtures::FIRST_NAME_MATHEUS,
            'last_name' => UserFixtures::LAST_NAME_MATHEUS,
            'email' => UserFixtures::EMAIL_MATHEUS,
            'password' => Hash::make(UserFixtures::DEFAULT_PASSWORD)
        ]);
    }
}
