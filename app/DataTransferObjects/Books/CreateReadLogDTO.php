<?php

namespace App\DataTransferObjects\Books;

use App\DataTransferObjects\BaseDTO;
use Illuminate\Support\Arr;

class CreateReadLogDTO extends BaseDTO
{
    /**
     * @param int $user_id
     * @param int $book_id
     * @param int $start_page
     * @param int $end_page
     */
    public function __construct(
        public int  $user_id,
        public int  $book_id,
        public int  $start_page,
        public int  $end_page,
    )
    {
    }

    public static function fromRequest($request): BaseDTO
    {
        return new self(
            user_id: $request->get('user_id'),
            book_id: $request->get('book_id'),
            start_page: $request->get('start_page'),
            end_page: $request->get('end_page'),
        );
    }


    /**
     * @param array $data
     * @return $this
     */
    public static function fromArray(array $data): BaseDTO
    {
        return new self(
            user_id: Arr::get($data, 'user_id'),
            book_id: Arr::get($data, 'book_id'),
            start_page: Arr::get($data, 'start_page'),
            end_page: Arr::get($data, 'end_page'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'book_id' => $this->book_id,
            'start_page' => $this->start_page,
            'end_page' => $this->end_page,
        ];
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'book_id' => 'required|integer',
            'start_page' => 'required|integer|min:1|',
            'end_page' => 'required|integer|min:1|gte:start_page',
        ];
    }
}
