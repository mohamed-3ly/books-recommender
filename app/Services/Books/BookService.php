<?php

namespace App\Services\Books;


use AllowDynamicProperties;
use App\DataTransferObjects\Books\CreateReadLogDTO;
use App\Events\UserReadBookEvent;
use App\Models\Book;
use App\Models\BooksUsersReadLog;
use App\Rules\LessThanOrEqualBookPages;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;

#[AllowDynamicProperties] class BookService extends BaseService
{
    public function __construct(
        protected Book              $book,
        protected BooksUsersReadLog $booksUsersReadLog,
    )
    {
        $this->seconds = 60 * 60 * 24;
    }

    public function getModel(): Book
    {
        return $this->book;
    }

    public function submitBookRead(CreateReadLogDTO $createReadLogDTO): void
    {
        $this->validateBeforeAddBookReadLog($createReadLogDTO);
        $model = $this->booksUsersReadLog->query()->firstOrCreate($createReadLogDTO->toArray());
        if ($model->wasRecentlyCreated === true) {
            event(new UserReadBookEvent($model->book));
        }
    }

    public function TopReadBooks()
    {
        return cache()->remember('most-read-5-books', $this->seconds, function () {
            return $this->getQuery()->orderByDesc('read')->take(5)->get();
        });
    }

    private function validateBeforeAddBookReadLog(CreateReadLogDTO $createReadLogDTO): void
    {
        $createReadLogDTO->validate();

        Validator::validate([
            'user_id' => $createReadLogDTO->user_id,
            'book_id' => $createReadLogDTO->book_id,
            'end_page' => $createReadLogDTO->end_page,
        ], [
            'user_id' => [
                'exists:users,id'
            ],
            'book_id' => [
                'exists:books,id',
            ],
            'end_page' => [
                new LessThanOrEqualBookPages,
            ],
        ]);
    }
}
