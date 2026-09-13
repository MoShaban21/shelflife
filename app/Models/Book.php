<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookCopy;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'isbn',
    ];

    public function copies(){
        return $this->hasMany(BookCopy::class);
    }
}
