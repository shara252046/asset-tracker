<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tumi agei tinker theke Admin banayecho, tai tini already database e achen.
        // Tobe future e jodi database reset koro, tokhon tar jonno ei code ta:
         User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ]
        );
    }
}
