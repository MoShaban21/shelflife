<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoanResource;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $loans = $request->user()
            ->loans()
            ->with('bookCopy.book')
            ->latest()
            ->get();

        return LoanResource::collection($loans);
    }
}
