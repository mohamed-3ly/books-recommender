<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BooksUsersReadLog extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = ['user_id', 'book_id', 'start_page', 'end_page'];

    public function Book()
    {
        return $this->belongsTo(Book::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
