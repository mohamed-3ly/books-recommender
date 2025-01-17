<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pages', 'read'];

    public function BooksReadLog(): HasMany
    {
        return $this->hasMany(BooksUsersReadLog::class, 'book_id', 'id');
    }
}
