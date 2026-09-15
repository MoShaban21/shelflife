<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LibrarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mostafa Shaban',
            'email' => 'mostafa@gmail.com',
            'phone' => '01028098345',
            'password' => '12345678',
            'role' => 'librarian',
        ]);
    }
}
