<?php

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns only the authenticated member loans', function () {
    $member = User::factory()->create(['role' => 'member']);
    $other = User::factory()->create(['role' => 'member']);

    $book = Book::factory()->create(['title' => 'Domain-Driven Design']);
    $copy = BookCopy::factory()->create(['book_id' => $book->id, 'copy_number' => 1]);
    $otherCopy = BookCopy::factory()->create([
        'book_id' => Book::factory()->create()->id,
        'copy_number' => 1,
    ]);

    Loan::factory()->create([
        'user_id' => $member->id,
        'book_copy_id' => $copy->id,
    ]);

    Loan::factory()->create([
        'user_id' => $other->id,
        'book_copy_id' => $otherCopy->id,
    ]);

    $token = $member->createToken('api-token')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/loans')
        ->assertOk();

    $response->assertJsonCount(1, 'data');
    $response->assertJsonFragment([
        'book_title' => 'Domain-Driven Design',
    ]);
});
