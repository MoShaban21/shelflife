<?php

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns books with available copy counts for an authenticated user', function () {
    $user = User::factory()->create([
        'role' => 'member',
    ]);

    $book = Book::factory()->create([
        'title' => 'Clean Code',
        'author' => 'Robert Martin',
    ]);

    BookCopy::factory()->create([
        'book_id' => $book->id,
        'copy_number' => 1,
    ]);

    $token = $user->createToken('api_token')->plainTextToken;

    $this->withHeader('Authorization', 'Bearer ' . $token)
        ->getJson('/api/books')
        ->assertOk()
        ->assertJsonFragment([
            'title' => 'Clean Code',
            'author' => 'Robert Martin',
            'available_copies_count' => 1,
        ]);
});
