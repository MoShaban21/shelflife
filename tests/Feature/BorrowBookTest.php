<?php

use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);
it('allows a member to borrow an available copy', function () {
    //Arange
    $member = User::factory()->create(['role' => 'member']);
    $book = Book::factory()->create();
    BookCopy::factory()->create([
        'book_id' => $book->id,
        'copy_number' => 1,
    ]);


    //Act
    $response = $this
        ->actingAs($member)
        ->post(route('member.books.borrow', $book));

    //Assert
    $response->assertRedirect(route('member.books.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('loans', [
        'user_id' => $member->id,
        'returned_at' => null,
    ]);

    expect(Loan::count())->toBe(1);
});

it('does not allow a member to borrow when no copies are available', function(){
    //Arange
    $member = User::factory()->create(['role' => 'member']);
    $book = Book::factory()->create();

    //Act
    $response = $this
    ->ActingAs($member)
    ->post(route('member.books.borrow', $book));
    
    //Assert
    $response->assertRedirect(route('member.books.index'));
    $response->assertSessionHas('error');

    expect(Loan::count())->toBe(0);
});

it('does not allow a member to borrow when they have an overdue loan', function(){
    $member = User::factory()->create(['role' => 'member']);

    $oldBook = Book::factory()->create();
    $oldCopy = BookCopy::factory()->create([
        'book_id' => $oldBook->id,
        'copy_number' => 1,
    ]);

    Loan::factory()->create([
        'user_id' => $member->id,
        'book_copy_id' => $oldCopy->id,
        'borrowed_at' => now()->subDays(20),
        'due_date' => now()->subDays(5),
        'returned_at' => null,
    ]);

    $newBook = Book::factory()->create();
    BookCopy::factory()->create([
        'book_id' => $newBook->id,
        'copy_number'=> 1,
    ]);

    $response = $this
    ->actingAs($member)
    ->post(route('member.books.borrow', $newBook));

    $response->assertRedirect(route('member.books.index'));
    $response->assertSessionHas('error');

    expect(Loan::count())->toBe(1);
    
});

it('does not allow a librarian to borrow a book', function(){
    $librarian = User::factory()->create(['role' => 'librarian']);
    $book = Book::factory()->create();
    BookCopy::factory()->create([
        'book_id' => $book->id,
        'copy_number' => 1,
    ]);

    $response = $this
    ->actingAs($librarian)
    ->post(route('member.books.borrow', ['book' => $book->id]));


    $response->assertForbidden();

    expect(Loan::count())->toBe(0);
});