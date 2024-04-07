<?php

namespace App\Rules;

use App\Models\Book;
use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class LessThanOrEqualBookPages implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $bookId = request()->input('book_id');

        $book = Book::find($bookId);

        if (!$book) {
            $fail('The :attribute must be less than or equal to the book\'s pages.');
        }

        if ($value > $book->pages) {
            $fail('The :attribute must be less than or equal to the book\'s pages.');
        }
    }
}
