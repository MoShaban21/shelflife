<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
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
        return $this->copies()->available()->first();
    }
}
