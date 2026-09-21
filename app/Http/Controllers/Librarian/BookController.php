<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Book::class);

        $books = Book::withCount('copies')->latest()->get();

        return view('librarian.books.index', compact('books'));
    }

    public function create()
    {
        $this->authorize('create', Book::class);

        return view('librarian.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $this->authorize('create', Book::class);

        $validated = $request->validated();

        Book::create($validated);

        return redirect()
            ->route('librarian.books.index')
            ->with('success', 'Book created successfully');
    }

    public function storeCopy(Request $request, Book $book)
    {
        $this->authorize('create', Book::class);
        $nextCopyNumber = ($book->copies()->max('copy_number') ?? 0) + 1;

        $book->copies()->create([
            'copy_number' => $nextCopyNumber,
        ]);

        return redirect()
            ->route('librarian.books.index')
            ->with('success', "Copy #{$nextCopyNumber} added successfully");
    }
}
