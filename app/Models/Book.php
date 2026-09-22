<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
    ];

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }

    public function availableCopy()
    {
        return $this->copies()->whereDoesntHave('loans', function ($query) {
            $query->whereNull('returned_at');
        })->first();
    }
}
