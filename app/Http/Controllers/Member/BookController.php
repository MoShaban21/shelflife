<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::withCount(['copies as available_copies_count' => function ($query) {
            $query->whereDoesntHave('loans', function ($q) {
                $q->whereNull('returned_at');
            });
        }])->latest()->get();

        return view('member.books.index', compact('books'));
    }

    public function borrow(Request $request, Book $book)
    {
        $this->authorize('create', Loan::class);

        if ($request->user()->hasOverdueLoans()) {
            return redirect()
                ->route('member.books.index')
                ->with('error', 'You cannot borrow a new book while you have an overdue loan.');
        }

        $copy = $book->availableCopy();

        if (! $copy) {
            return redirect()->route('member.books.index')->with('error', 'No available copies for this book.');
        }

        Loan::create([
            'user_id' => $request->user()->id,
            'book_copy_id' => $copy->id,
            'borrowed_at' => now(),
            'due_date' => now()->addDays(14),
            'returned_at' => null,
        ]);

        return redirect()->route('member.books.index')->with('success', 'Book borrowed successfully. Due in 14 days.');
    }
}
