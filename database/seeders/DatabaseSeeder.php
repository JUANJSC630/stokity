<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Juan Saldarriaga',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'photo' => 'https://ui-avatars.com/api/?name=Juan+Saldarriaga&background=random&color=fff&size=128',
            'role' => 'admin',
            'status' => 1,
            'last_login' => '',
            'branch_id' => 0,
        ]);
    }
}
