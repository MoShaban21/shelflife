<?php

namespace Database\Factories;

use App\Models\BookCopy;
use App\Models\loan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'book_copy_id' => BookCopy::factory(),
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14),
            'returned_at' => null,
        ];
    }
}
