<?php

namespace App\Services\Books;


use App\DataTransferObjects\Books\CreateReadLogDTO;
use App\Events\UserReadBookEvent;
use App\Models\Book;
use App\Models\BooksUsersReadLog;
use App\Rules\LessThanOrEqualBookPages;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;

class BookService extends BaseService
{
    public function __construct(
        protected Book              $book,
        protected BooksUsersReadLog $booksUsersReadLog,
    )
    {
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
