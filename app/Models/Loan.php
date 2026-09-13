<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BookCopy;
class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_copy_id',
        'borrowed_at',
        'due_date',
        'returned_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function bookCopy(){
        return $this->belongsTo(BookCopy::class);
    }
}
