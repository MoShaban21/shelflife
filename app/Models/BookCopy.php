<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookCopy extends Model
{
    protected $fillable = [
        'book_id',
        'copy_number',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function scopeAvailable($query)
    {
        return $query->whereDoesntHave('loans', function ($q) {
            $q->whereNull('returned_at');
        });
    }
}
