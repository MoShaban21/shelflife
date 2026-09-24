<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $this->authorize('update', Loan::class);

        $loans = Loan::active()
            ->with(['user', 'bookCopy.book'])
            ->latest()
            ->get();


        return view('librarian.loans.index', compact('loans'));
    }

    public function returnBook(Request $request, Loan $loan)
    {
        $this->authorize('update', $loan);

        if ($loan->returned_at !== null) {
            return redirect()->route('librarian.loans.index')->with('error', 'This loan has already been returned.');
        }

        $loan->update([
            'returned_at' => now(),
        ]);

        return redirect()->route('librarian.loans.index')->with('success', 'Book marked as returned');
    }
}
