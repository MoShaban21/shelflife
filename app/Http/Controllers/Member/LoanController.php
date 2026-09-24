<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = $request->user()
            ->loans()
            ->with(['bookCopy.book'])
            ->latest()
            ->get();

        return view('member.loans.index', compact('loans'));
    }
}
