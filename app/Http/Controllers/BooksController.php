<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\DataTransferObjects\Books\CreateReadLogDTO;
use App\Http\Requests\SubmitBookReadRequest;
use App\Http\Resources\BooksResource;
use App\Services\Books\BookService;
use Illuminate\Http\JsonResponse;

class BooksController extends Controller
{
    public function __construct(protected BookService $bookService)
    {
    }

    public function SubmitReading(SubmitBookReadRequest $request): JsonResponse
    {
        $read_log = CreateReadLogDTO::fromRequest($request);
        $this->bookService->submitBookRead($read_log);
        return new JsonResponse(['message' => 'thanks']);
    }

    public function TopReadBooks(): JsonResponse
    {
        $books =  $this->bookService->topReadBooks();
        return new JsonResponse(['data' => BooksResource::collection($books)]);
    }
}
