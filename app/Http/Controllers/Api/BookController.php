<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->withCount(['copies' => function ($query) {
                $query->available();
            }])
            ->latest()
            ->get();

        return BookResource::collection($books);
    }
}
