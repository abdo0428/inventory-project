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
        // User::factory(10)->create();

      /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
*/
        $this->call(\Database\Seeders\UserSeeder::class);
        $this->call(\Database\Seeders\ProductSeeder::class);

    }
}
//this file is for seeding the database, so i will not add any code here, but in future if i need to add any code that is common for all seeders, i will add it here.
