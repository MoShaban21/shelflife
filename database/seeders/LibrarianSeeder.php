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
        User::updateOrCreate(
            ['email' => 'admin@shelflife.test'],
            [
                'name' => 'Library Admin',
                'phone' => '01000000000',
                'password' => 'password',
                'role' => 'librarian',
            ]
        );
    }
}
